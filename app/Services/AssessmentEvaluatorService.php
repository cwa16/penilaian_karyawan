<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class AssessmentEvaluatorService
{
    /* ===============================
     * MANAGER AREA
     * =============================== */
    public function managerCanAssess(string $managerNik, string $dept): bool
    {
        return DB::table('manager_department_assessments')
            ->where('manager_nik', $managerNik)
            ->where('dept', $dept)
            ->exists();
    }

    /* ===============================
     * LIST VISIBILITY (TIDAK BOLEH ABORT)
     * =============================== */
    public function canSeeEmployee(User $evaluator, User $employee): bool
    {
        // ===== MONTHLY =====
        if (strtolower($employee->status) === 'monthly') {

            // staff → monthly (dept sama)
            if (strtolower($evaluator->status) === 'staff') {
                return $evaluator->dept === $employee->dept;
            }

            // manager → monthly (dept di-setting)
            if (strtolower($evaluator->status) === 'manager') {
                return $this->managerCanAssess(
                    $evaluator->nik,
                    $employee->dept
                );
            }

            return false;
        }

        // ===== STAFF =====
        if (strtolower($employee->status) === 'staff') {

            // manager → staff
            if (strtolower($evaluator->status) === 'manager') {
                return $this->managerCanAssess(
                    $evaluator->nik,
                    $employee->dept
                );
            }

            // director → staff
            if (strtolower($evaluator->status) === 'manager' && strtolower($evaluator->jabatan) === 'dir') {
                return true;
            }

            return false;
        }

        return false;
    }

    /* ===============================
     * SLOT LOGIC (FORM & SAVE ONLY)
     * =============================== */
    public function getEvaluatorSlot(User $evaluator, User $employee): int
    {
        if (strtolower($employee->status) === 'monthly') {

            if (strtolower($evaluator->status) === 'staff') {
                if ($evaluator->dept !== $employee->dept) {
                    abort(403);
                }
                return 1;
            }

            if (strtolower($evaluator->status) === 'manager' && strtolower($evaluator->jabatan) === 'dir') {
                if (! $this->managerCanAssess($evaluator->nik, $employee->dept)) {
                    abort(403);
                }
                return 2;
            }
        }

        if (strtolower($employee->status) === 'staff') {

            if (strtolower($evaluator->status) === 'manager') {
                if (! $this->managerCanAssess($evaluator->nik, $employee->dept)) {
                    abort(403);
                }
                return 1;
            }

            if (strtolower($evaluator->status) === 'manager' && strtolower($evaluator->jabatan) === 'dir') {
                return 2;
            }
        }

        abort(403, 'Tidak berhak menilai karyawan ini');
    }

    public function getExpectedEvaluators(User $employee): array
    {
        // ===== MONTHLY =====
        if (strtolower($employee->status) === 'monthly') {

            $penilai1 = User::where('status', 'staff')
                ->where('dept', $employee->dept)
                ->get();

            $penilai2 = User::where('status', 'manager')
                ->whereIn('nik', function ($q) use ($employee) {
                    $q->select('manager_nik')
                        ->from('manager_department_assessments')
                        ->where('dept', $employee->dept);
                })
                ->get();

            return [$penilai1, $penilai2];
        }

        // ===== STAFF =====
        if (strtolower($employee->status) === 'staff') {

            $penilai1 = User::where('status', 'manager')
                ->whereIn('nik', function ($q) use ($employee) {
                    $q->select('manager_nik')
                        ->from('manager_department_assessments')
                        ->where('dept', $employee->dept);
                })
                ->get();

            $penilai2 = User::where('status', 'director')->get();

            return [$penilai1, $penilai2];
        }

        return [collect(), collect()];
    }

    public function validateEvaluatorForSlot(User $evaluator, User $employee): int
    {
        // Cek boleh menilai atau tidak (dept & setting)
        $this->validateEvaluator($evaluator, $employee);

        // Tentukan slot
        return $this->getEvaluatorSlot($evaluator, $employee);
    }

    public function canEvaluatorSeeEmployee(User $evaluator, User $employee): bool
    {
        // Staff → Monthly → harus satu dept
        if (
            strtolower($evaluator->status) === 'staff' &&
            strtolower($employee->status) === 'monthly'
        ) {
            return $evaluator->dept === $employee->dept;
        }

        // Manager → harus di-setting
        if (strtolower($evaluator->status) === 'manager') {
            return $this->managerCanAssess(
                $evaluator->nik,
                $employee->dept
            );
        }

        // Director / HR
        return true;
    }

    /**
     * Validasi keras (untuk form & submit)
     */
    public function validateEvaluator(User $evaluator, User $employee): void
    {
        if (! $this->canEvaluatorSeeEmployee($evaluator, $employee)) {
            abort(403, 'Anda tidak berhak menilai karyawan ini');
        }
    }
}

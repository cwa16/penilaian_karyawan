<x-app-layout>

    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-6 text-sm">

        {{-- JUDUL --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">
                Monitoring Penilaian Karyawan
            </h2>
        </div>

        <div class="-mx-6 border-b border-slate-100 mt-2 mb-6"></div>

        {{-- FILTER --}}
        <form method="GET" class="flex gap-4 mb-6">

            {{-- Filter Dept --}}
            <div>
                <select name="dept"
                    class="border border-gray-300 rounded px-3 py-1 text-sm w-48">

                    <option value="">Semua Dept</option>

                    @foreach($departments as $d)
                        <option value="{{ $d }}"
                            {{ request('dept') == $d ? 'selected' : '' }}>
                            {{ $d }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Tahun / Periode --}}
            <div>
                <select name="period"
                    class="border border-gray-300 rounded px-3 py-1 text-sm w-40">

                    <option value="">Semua Tahun</option>

                    @foreach($periods as $p)
                        <option value="{{ $p->id }}"
                            {{ request('period') == $p->id ? 'selected' : '' }}>
                            {{ $p->year }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Button --}}
            <div class="flex items-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                    Filter
                </button>
            </div>

        </form>

        {{-- TABLE --}}
        <table class="w-full border text-center text-sm">

            <thead>
                <tr class="bg-gray-100 font-semibold">
                    <!-- Kolom utama gabung 2 baris -->
                    <th rowspan="2" class="border px-2 py-1">No</th>
                    <th rowspan="2" class="border px-2 py-1">NIK</th>
                    <th rowspan="2" class="border px-2 py-1">Nama</th>
                    <th rowspan="2" class="border px-2 py-1">Dept</th>
                    <th rowspan="2" class="border px-2 py-1">Tahun</th>

                    <!-- Penilai -->
                    <th colspan="2" class="border px-2 py-1">
                        Penilai 1
                    </th>

                    <th colspan="2" class="border px-2 py-1">
                        Penilai 2
                    </th>
                </tr>

                <tr class="bg-gray-100 font-semibold">
                    <!-- Sub header Penilai -->
                    <th class="border px-2 py-1">Nama</th>
                    <th class="border px-2 py-1">Status</th>

                    <th class="border px-2 py-1">Nama</th>
                    <th class="border px-2 py-1">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($assessments as $i => $row)
                    <tr class="hover:bg-gray-50 text-xs">
                        <td class="border px-2 py-1">{{ $i+1 }}</td>
                        <td class="border px-2 py-1">{{ $row->nik }}</td>
                        <td class="border px-2 py-1 text-left">{{ $row->employee_name }}</td>
                        <td class="border px-2 py-1 text-left">{{ $row->dept }}</td>
                        <td class="border px-2 py-1">{{ $row->year }}</td>

                        {{-- Penilai 1 --}}
                        <td class="border px-2 py-1 text-left">
                            {{ $row->assessor1_name ?? '-' }}
                        </td>
                        <td class="border px-2 py-1 font-semibold">
                            {{ $row->status_assessor1 }}
                        </td>

                        {{-- Penilai 2 --}}
                        <td class="border px-2 py-1 text-left">
                            {{ $row->assessor2_name ?? '-' }}
                        </td>
                        <td class="border px-2 py-1 font-semibold">
                            {{ $row->status_assessor2 }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-4 text-gray-500">
                            Tidak ada data monitoring.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
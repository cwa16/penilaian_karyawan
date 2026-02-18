<x-app-layout>
<div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-6 text-sm">

    {{-- JUDUL --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold">
            Detail Per-karyawan
        </h2>

        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-5 py-2 bg-gray-100 text-gray-900 rounded-lg text-xs border border-gray-200 hover:bg-gray-50">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
                </svg>
            Kembali Ke Summary
        </a>
    </div>

    <div class="-mx-6 border-b border-slate-100 mt-4 mb-6"></div>

    {{-- IDENTITAS --}}
    <div class="grid grid-cols-2 gap-y-2 mb-6">
        <div class="flex gap-2">
            <div class="w-28">NIK</div>
            <div>: {{ $employee->nik }}</div>
        </div>

        <div class="flex gap-2">
            <div class="w-28">Dept</div>
            <div>: {{ $employee->dept }}</div>
        </div>

        <div class="flex gap-2">
            <div class="w-28">Nama</div>
            <div>: {{ $employee->name }}</div>
        </div>

        <div class="flex gap-2">
            <div class="w-28">Jabatan</div>
            <div>: {{ $employee->jabatan ?? '-' }}</div>
        </div>

        <div class="flex gap-2 col-span-2">
            <div class="w-28">Mulai Kerja</div>
            <div>: -</div>
        </div>
    </div>

    {{-- TABLE --}}
    <table class="w-full border border-black text-center">
        <thead>
            <tr class="bg-blue-200 font-semibold">
                <th rowspan="2" class="border border-black px-1 py-1">Tahun</th>
                <th rowspan="2" class="border border-black px-1 py-1">Dept</th>
                <th rowspan="2" class="border border-black px-1 py-1">Jabatan</th>
                <th colspan="2" class="border border-black px-1 py-1">
                    Skor KPI 60%
                </th>
                <th colspan="2" class="border border-black px-1 py-1">
                    Skor Qualitatif 40%
                </th>
                <th rowspan="2" class="border border-black px-1 py-1">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($histories as $row)
            <tr>
                <td class="border border-black px-2 py-1">
                    {{ $row['year'] }}
                </td>

                <td class="border border-black px-2 py-1">
                    {{ $row['dept'] }}
                </td>

                <td class="border border-black px-2 py-1">
                    {{ $row['position'] }}
                </td>

                {{-- KPI (KOSONG) --}}
                <td class="border border-black px-2 py-1"></td>
                <td class="border border-black px-2 py-1"></td>

                {{-- QUALITATIF --}}
                <td class="border border-black px-2 py-1">
                    {{ $row['persen'] }}%
                </td>
                <td class="border border-black px-2 py-1">
                    {{ $row['hasil_qualitatif'] }}%
                </td>

                {{-- TOTAL (KOSONG) --}}
                <td class="border border-black px-2 py-1"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>

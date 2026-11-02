<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logobskp2.png') }}" 
                alt="Company Logo" 
                class="h-10 w-auto">
            
            <div>
                <h1 class="text-lg font-semibold text-gray-800 leading-tight">
                    PT. Bridgestone Kalimantan Plantation
                </h1>
                <p class="text-sm text-gray-500">
                    Performance Management System
                </p>
            </div>
        </div>
    </div>
<div class="max-w-7xl mx-auto bg-white rounded-xl shadow p-6 text-sm">

    {{-- JUDUL --}}
    <div class="flex items-center mb-4">
        <h2 class="text-2xl font-semibold">
            Detail Penilaian Karyawan
        </h2>

        <div class="ml-auto flex items-center gap-2">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-md text-sm border hover:bg-gray-200 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>

            <a href="{{ route('summary.export.pdf', $employee->nik) }}"
                target="_blank"
                class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-500 text-white rounded-md text-sm hover:bg-red-600 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 16v-8m0 8l-3-3m3 3l3-3M4 20h16" />
                </svg>
                Export PDF
            </a>
        </div>
    </div>

    <div class="-mx-6 border-b border-slate-100 mt-4 mb-6"></div>

    {{-- IDENTITAS --}}
    <div class="grid grid-cols-2 gap-y-2 mb-6">
        <div class="flex gap-0.5">
            <div class="w-28">NIK</div>
            <div>: {{ $employee->nik }}</div>
        </div>

        <div class="flex gap-0.5">
            <div class="w-28">Dept</div>
            <div>: {{ $employee->dept }}</div>
        </div>

        <div class="flex gap-0.5">
            <div class="w-28">Nama</div>
            <div>: {{ $employee->name }}</div>
        </div>

        <div class="flex gap-0.5">
            <div class="w-28">Jabatan</div>
            <div>: {{ $employee->jabatan ?? '-' }}</div>
        </div>

        <div class="flex gap-0.5 col-span-2">
            <div class="w-28">Mulai Kerja</div>
            <div>: -</div>
        </div>
    </div>

    {{-- TABLE --}}
    <table class="w-full border border-black text-center">
        <thead>
            <tr class="bg-blue-200 font-semibold">
                <th rowspan="2" class="border border-black px-1 py-1">Tahun</th>
                <th rowspan="2" class="border border-black px-1 py-1">Departemen</th>
                <th rowspan="2" class="border border-black px-1 py-1">Jabatan</th>
                <th colspan="2" class="border border-black px-1 py-1">
                    Skor KPI 60%
                </th>
                <th colspan="2" class="border border-black px-1 py-1">
                    Skor Qualitatif 40%
                </th>
                <th rowspan="2" class="border border-black px-1 py-1">Total</th>
                <tr class="bg-blue-200 font-semibold">
                    <th class="border border-black px-1 py-1">S. Original</th>
                    <th class="border border-black px-1 py-1">S. Final</th>
                    <th class="border border-black px-1 py-1">S. Original</th>
                    <th class="border border-black px-1 py-1">S. Final</th>
                </tr>
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

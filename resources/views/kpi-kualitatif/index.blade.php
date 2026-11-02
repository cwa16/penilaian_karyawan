<x-app-layout>
    <div x-data="{ openImport:false }">
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

    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">
                    KPI Kualitatif - {{ $period->year }}
                </h2>

                <a href="{{ route('kpi-kualitatif.periods') }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-md text-sm border text-gray-700 hover:bg-gray-200 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            
            {{-- IMPORT FORM --}}
            <form action="{{ route('kpi-kualitatif.import', ['period' => $period->id]) }}" 
                method="POST" 
                enctype="multipart/form-data" 
                class="flex items-center gap-3 mb-6">
                @csrf

                <input type="file" name="file"
                    class="border border-gray-300 px-3 py-1 text-sm shadow">

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-1 text-sm rounded hover:bg-blue-700 shadow-md">
                    IMPORT
                </button>
            </form>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @php
            function excelPercent($value, $isPercentColumn = true) {
                if ($value === null) return '-';
                
                if ($isPercentColumn) {
                    // Konversi desimal Excel ke persen dan tampilkan 1 desimal
                    return number_format($value * 100, 1) . '%';
                }
                
                return $value; // Untuk kolom non-persen
            }
            @endphp

            {{-- TABLE --}}
            <div class="overflow-x-auto">

            <table class="min-w-full border border-gray-300 text-xs">
                <thead class="bg-blue-600 text-white text-xs text-center">

                    <tr>

                    <th rowspan="2" class="border px-2 py-2">No</th>
                    <th rowspan="2" class="border px-2 py-2">NIK</th>
                    <th rowspan="2" class="border px-2 py-2">Nama</th>
                    <th rowspan="2" class="border px-2 py-2">Status</th>
                    <th rowspan="2" class="border px-2 py-2">Dept</th>
                    <th rowspan="2" class="border px-2 py-2">Posisi</th>

                    <th colspan="2" class="border px-2 py-2 whitespace-nowrap">KPI Dept (30%)</th>
                    <th colspan="2" class="border px-2 py-2 whitespace-nowrap">KPI Individu (70%)</th>

                    <th rowspan="2" class="border px-2 py-2">Total</th>

                    <th rowspan="2" class="border px-2 py-2">Assesment dari KPI (60%)</th>

                    <th colspan="2" class="border px-2 py-2 whitespace-nowrap">Assesment Atasan (40%)</th>

                    <th rowspan="2" class="border px-2 py-2">Total Assesment (100%)</th>

                    <th colspan="9" class="border px-2 py-2">Pengurang Score</th>
                    <th rowspan="2" class="border px-2 py-2">Pengurang Skor</th>

                    <th rowspan="2" class="border px-2 py-2">Assesment Final</th>
                    <th rowspan="2" class="border px-2 py-2">Grade</th>

                    </tr>


                    <tr>

                    <th class="border px-2 py-2 whitespace-nowrap">Full Year</th>
                    <th class="border px-2 py-2">Result</th>

                    <th class="border px-2 py-2 whitespace-nowrap">Full Year</th>
                    <th class="border px-2 py-2">Result</th>

                    <th class="border px-2 py-2">Assesment</th>
                    <th class="border px-2 py-2">Result</th>

                    <th class="border px-2 py-2">% Kehadiran</th>
                    <th class="border px-2 py-2">Pengurang Skor</th>

                    <th class="border px-2 py-2">% Late</th>
                    <th class="border px-2 py-2">Pengurang Skor</th>

                    <th class="border px-2 py-2">ST</th>
                    <th class="border px-2 py-2">SP1</th>
                    <th class="border px-2 py-2">SP2</th>
                    <th class="border px-2 py-2">SP3</th>

                    <th class="border px-2 py-2">Pengurang Skor</th>

                    </tr>

                </thead>

                <tbody>
                    @foreach($kualitatifs as $index => $data)
                        <tr class="text-[px-7] text-center">

                        <td class="border px-1 py-1.5">{{ $index+1 }}</td>
                        <td class="border px-1 py-1.5 whitespace-nowrap">{{ $data->nik }}</td>
                        <td class="border px-1 py-1.5 whitespace-nowrap text-left">{{ $data->nama }}</td>
                        <td class="border px-1 py-1.5 whitespace-nowrap text-left">{{ $data->status }}</td>
                        <td class="border px-1 py-1.5 whitespace-nowrap text-left">{{ $data->dept }}</td>
                        <td class="border px-1 py-1.5 whitespace-nowrap text-left">{{ $data->posisi }}</td>

                        <td class="border px-1 py-1.5">{{ $data->kpi_dept_full_year }}</td>
                        <td class="border px-1 py-1.5">{{ $data->kpi_dept_result }}</td>

                        <td class="border px-1 py-1.5">{{ $data->kpi_individu_full_year }}</td>
                        <td class="border px-1 py-1.5">{{ $data->kpi_individu_result }}</td>

                        <td class="border px-1 py-1.5">{{ $data->total_kpi }}</td>

                        <td class="border px-1 py-1.5">{{ $data->assessment_kpi }}</td>
                        <td class="border px-1 py-1.5">{{ $data->assessment_kpi_result }}</td>

                        <td class="border px-1 py-1.5">{{ $data->assessment_atasan }}</td>
                        <td class="border px-1 py-1.5">{{ $data->assessment_atasan_result }}</td>

                        <td class="border px-1 py-1.5">{{ $data->total_assessment }}</td>

                        <td class="border px-1 py-1.5">{{ $data->kehadiran }}</td>
                        <td class="border px-1 py-1.5">{{ $data->pengurang_kehadiran }}</td>

                        <td class="border px-1 py-1.5">{{ $data->late }}</td>
                        <td class="border px-1 py-1.5">{{ $data->pengurang_late }}</td>

                        <td class="border px-1 py-1.5">{{ $data->st ?? '-' }}</td>
                        <td class="border px-1 py-1.5">{{ $data->sp1 ?? '-' }}</td>
                        <td class="border px-1 py-1.5">{{ $data->sp2 ?? '-' }}</td>
                        <td class="border px-1 py-1.5">{{ $data->sp3 ?? '-' }}</td>

                        <td class="border px-1 py-1.5">{{ $data->pengurang_score }}</td>

                        <td class="border px-1 py-1.5">{{ $data->assessment_final }}</td>
                        <td class="border px-1 py-1.5">{{ $data->grade }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-app-layout>
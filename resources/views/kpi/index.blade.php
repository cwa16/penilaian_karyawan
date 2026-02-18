<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <h2 class="text-xl font-semibold mb-4">
                KPI Asessment
            </h2>

            {{-- IMPORT FORM --}}
            <form action="{{ route('kpi.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 mb-6">
                @csrf
                <input type="file" name="file"
                    class="border border-gray-300 px-3 py-1 text-sm">

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-1 text-sm rounded hover:bg-blue-700">
                    IMPORT
                </button>
            </form>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2">No</th>
                            <th class="border px-3 py-2">Tahun</th>
                            <th class="border px-3 py-2">NIK</th>
                            <th class="border px-3 py-2">Nama</th>
                            <th class="border px-3 py-2">Dept</th>
                            <th class="border px-3 py-2">Jabatan</th>
                            <th class="border px-3 py-2">Posisi</th>
                            <th class="border px-3 py-2">Total KPI (%)</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kpis as $index => $kpi)
                            <tr>
                                <td class="border px-3 py-2">{{ $index + 1 }}</td>
                                <td class="border px-3 py-2">{{ $kpi->tahun }}</td>
                                <td class="border px-3 py-2">{{ $kpi->nik }}</td>
                                <td class="border px-3 py-2">{{ $kpi->nama }}</td>
                                <td class="border px-3 py-2">{{ $kpi->dept }}</td>
                                <td class="border px-3 py-2">{{ $kpi->jabatan }}</td>
                                <td class="border px-3 py-2">{{ $kpi->posisi }}</td>
                                <td class="border px-3 py-2">{{ $kpi->total_kpi }}</td>
                                <td class="border px-3 py-2 text-center">
                                    <a href="{{ route('kpi.show', $kpi->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 text-xs rounded hover:bg-blue-600">
                                        Detail
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-gray-500">
                                    Belum ada data KPI.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

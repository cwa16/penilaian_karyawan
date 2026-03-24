<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">
                    Detail KPI
                </h2>

                <a href="{{ route('kpi.index') }}"
                    class="bg-gray-500 text-white px-4 py-1 text-sm rounded hover:bg-gray-600">
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Tahun</p>
                    <p class="font-semibold">{{ $kpi->tahun }}</p>
                </div>

                <div>
                    <p class="text-gray-500">NIK</p>
                    <p class="font-semibold">{{ $kpi->nik }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Nama</p>
                    <p class="font-semibold">{{ $kpi->nama }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Dept</p>
                    <p class="font-semibold">{{ $kpi->dept }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Jabatan</p>
                    <p class="font-semibold">{{ $kpi->jabatan }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Posisi</p>
                    <p class="font-semibold">{{ $kpi->posisi }}</p>
                </div>

                <div class="col-span-2">
                    <p class="text-gray-500">Total KPI (%)</p>
                    <p class="text-lg font-bold text-blue-600">
                        {{ $kpi->total_kpi }} %
                    </p>
                </div>

            </div>

        </div>

    </div>
</x-app-layout>
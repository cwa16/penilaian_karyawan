<x-app-layout>
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">
                Master Criteria Penilaian
            </h2>

            <a href="{{ route('criteria.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                + Tambah Criteria
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="mb-3 text-green-600 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full border text-sm">

                {{-- HEADER TABEL --}}
                <thead class="bg-gray-100 text-center align-middle">
                {{-- BARIS 1 --}}
                <tr>
                    <th rowspan="3" class="p-1 border w-6 text-center">No</th>
                    <th rowspan="3" class="p-1 border w-28 text-center">Aspek Penilaian PA</th>
                    <th rowspan="3" class="p-1 border w-28 text-center">Definisi</th>
                    <th colspan="5" class="p-1 border">Kategori Penilaian</th>
                    <th rowspan="3" class="p-1 border w-10">Bobot</th>
                    <th rowspan="3" class="p-1 border w-10">Aksi</th>
                </tr>

                {{-- BARIS 2 --}}
                <tr>
                    <th class="p-1 border font-medium w-25">Kurang</th>
                    <th class="p-1 border font-medium w-25">Cukup</th>
                    <th class="p-1 border font-medium w-25">Baik</th>
                    <th class="p-1 border font-medium w-25">Baik Sekali</th>
                    <th class="p-1 border font-medium w-25">Istimewa</th>
                </tr>

                {{-- BARIS 3 --}}
                <tr>
                    <th class="p-1 border font-medium">I</th>
                    <th class="p-1 border font-medium">II</th>
                    <th class="p-1 border font-medium">III</th>
                    <th class="p-1 border font-medium">IV</th>
                    <th class="p-1 border font-medium">V</th>
                </tr>
            </thead>


                <tbody>
                @php $currentSection = null; @endphp

                @foreach($criteria as $c)

                    {{-- HEADER SECTION --}}
                    @if($currentSection !== $c->section)

                        @php
                            // WARNA SECTION SESUAI HRD
                            $sectionColor = match(strtolower($c->section)) {
                                'hasil kerja' => 'bg-blue-200',
                                'sikap kerja' => 'bg-yellow-200',
                                'disiplin' => 'bg-green-200',
                                'kerjasama' => 'bg-red-200',
                                'kematangan / kedewasaan' => 'bg-orange-200',
                                'inisiatif' => 'bg-green-200',
                                'kreativitas' => 'bg-blue-200',
                                'pengembangan wawasan pengetahuan' => 'bg-yellow-200',
                                'kemampuan manajerial' => 'bg-purple-200',
                            }
                        @endphp

                        <tr class="{{ $sectionColor }}">
                            <td colspan="10" class="p-1 font-bold text-gray-800 text-sm">
                                {{ $c->section }}
                            </td>
                        </tr>

                        @php $currentSection = $c->section; @endphp
                    @endif

                    {{-- ROW CRITERIA --}}
                    <tr class="hover:bg-gray-50 align-top text-xs">
                        <td class="p-2 border text-center font-semibold">
                            {{ $c->code }}
                        </td>

                        <td class="p-2 border font-medium">
                            {{ $c->name }}
                        </td>

                        <td class="p-2 border text-gray-700 whitespace-normal">
                            {{ $c->description }}
                        </td>

                        {{-- SCALE DESCRIPTIONS (LOGIKA ASLI, AMAN) --}}
                        <td class="p-1 border text-xs">
                            {{ optional($c->scales->where('score', 1)->first())->description ?? '-' }}
                        </td>
                        <td class="p-1 border text-xs">
                            {{ optional($c->scales->where('score', 2)->first())->description ?? '-' }}
                        </td>
                        <td class="p-1 border text-xs">
                            {{ optional($c->scales->where('score', 3)->first())->description ?? '-' }}
                        </td>
                        <td class="p-1 border text-xs">
                            {{ optional($c->scales->where('score', 4)->first())->description ?? '-' }}
                        </td>
                        <td class="p-1 border text-xs">
                            {{ optional($c->scales->where('score', 5)->first())->description ?? '-' }}
                        </td>

                        <td class="p-1 border text-center font-semibold">
                            {{ $c->weight }}%
                        </td>

                        <td class="p-2 border text-center">
                            <div class="flex justify-center gap-1">
                                <a href="{{ route('criteria.edit', $c->id) }}"
                                   class="px-2 py-1 text-xs bg-blue-50 text-blue-600 rounded hover:bg-blue-100">
                                    Edit
                                </a>

                                <form action="{{ route('criteria.destroy', $c->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin mau hapus kriteria ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-2 py-1 text-xs bg-red-50 text-red-600 rounded hover:bg-red-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
</x-app-layout>

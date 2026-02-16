<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Pilih Karyawan – {{ $period->name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Periode {{ $period->start_date }} — {{ $period->end_date }}
                    </p>
                </div>

                <a href="{{ route('admin.performance.periods.index') }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-md text-sm border hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali Ke Periode
                </a>
            </div>

            {{-- Search --}}
            <div class="px-6 py-3 border-b border-gray-50 flex justify-between">
                <div class="relative w-full max-w-sm">
                    <input type="search" placeholder="Cari nama / NIK / jabatan"
                        class="w-full pl-9 pr-3 py-1.5 border rounded-md text-sm focus:ring-2 focus:ring-indigo-200" />
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border-collapse">
                    <thead class="bg-gray-900 text-white">
                        <tr>
                            <th class="px-1 py-2 w-8 text-center">No</th>
                            <th class="px-1 py-2 w-24 text-left">NIK</th>
                            <th class="px-2 py-2 text-left">Nama</th>
                            <th class="px-1 py-2 w-20 text-left">Dept</th>
                            <th class="px-1 py-2 w-24 text-left">Jabatan</th>
                            <th class="px-1 py-2 w-16 text-center">Pdk</th>
                            <th class="px-1 py-2 w-28 text-center">Status</th>
                            <th class="px-1 py-2 w-36 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($rows as $i => $r)
                            <tr class="hover:bg-gray-50">
                                <td class="px-1 py-1.5 text-center text-gray-600">
                                    {{ $i + 1 }}
                                </td>

                                <td class="px-1 py-1.5 whitespace-nowrap">
                                    {{ $r['nik'] }}
                                </td>

                                <td class="px-2 py-1.5 font-semibold text-gray-800 max-w-[220px] truncate whitespace-nowrap"
                                    title="{{ $r['name'] }}">
                                    {{ $r['name'] }}
                                </td>

                                <td class="px-1 py-1.5 whitespace-nowrap">
                                    {{ $r['dept'] }}
                                </td>

                                <td class="px-1 py-1.5 whitespace-nowrap">
                                    {{ $r['jabatan'] }}
                                </td>

                                <td class="px-1 py-1.5 text-center">
                                    {{ $r['pendidikan'] }}
                                </td>

                                <td class="px-1 py-1.5 text-center">
                                    @if (!$r['assessment'])
                                        <span class="px-2 py-0.5 text-xs rounded-full bg-gray-100">
                                            Belum
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs rounded-full
                                            {{ $r['assessment']->status === 'approved' ? 'bg-green-100 text-green-700' :
                                               ($r['assessment']->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ strtoupper($r['assessment']->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-1 py-1.5 text-center">
                                    <div class="inline-flex gap-1">
                                        <a href="{{ route('performance.input', ['periodId' => $period->id, 'nik' => $r['nik']]) }}"
                                            class="px-2 py-1 bg-blue-600 text-white whitespace-nowrap rounded text-xs hover:bg-blue-700"
                                        >
                                            Isi penilaian
                                        </a>
                                        <a href="#"
                                            class="px-2 py-1 bg-gray-100 border rounded text-xs hover:bg-gray-50">
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-6 text-center text-gray-500">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-3 border-t text-sm text-gray-500">
                Menampilkan {{ $rows->count() }} karyawan
            </div>

        </div>
    </div>
</x-app-layout>
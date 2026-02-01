<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        {{-- Card --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            {{-- Header --}}
            <div
                class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Pilih Karyawan – {{ $period->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Periode: <time datetime="{{ $period->start_date }}">{{ $period->start_date }}</time>
                        <span class="mx-2 text-gray-300">—</span>
                        <time datetime="{{ $period->end_date }}">{{ $period->end_date }}</time>
                    </p>
                </div>

                <div class="flex items-center gap-3">
                   <a href="{{ route('admin.performance.periods.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm border border-gray-200 hover:bg-gray-50">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    Kembali ke Periode
                    </a>

                </div>
            </div>

            {{-- Controls --}}
            <div
                class="px-6 py-4 border-b border-gray-50 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div class="flex items-center gap-3 w-full md:w-1/2">
                    <label class="relative w-full">
                        <input type="search" name="q" placeholder="Cari nama, NIK, atau jabatan"
                            class="w-full pl-10 pr-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path>
                        </svg>
                    </label>

                    {{-- <select class="text-sm border rounded-md px-3 py-2 bg-white" name="filter_dept">
                        <option value="">Semua Dept</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select> --}}
                </div>

                <div class="flex items-center gap-3">
                    <a href="#"
                        class="inline-flex items-center gap-2 px-3 py-2 bg-blue-100 text-gray-700 rounded-md text-sm border border-blue-200 hover:bg-blue-50">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5">
                            </path>
                        </svg>
                        Export
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left w-12">No</th>
                            <th class="px-4 py-3 text-left w-28">NIK</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left w-36">Dept</th>
                            <th class="px-4 py-3 text-left w-36">Jabatan</th>
                            <th class="px-4 py-3 text-left w-36">Pendidikan</th>
                            <th class="px-4 py-3 text-center w-36">Status Penilaian</th>
                            <th class="px-4 py-3 text-center w-36">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($rows as $i => $r)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-600 text-center">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-gray-700 font-medium">{{ $r['nik'] }}</td>
                                <td class="px-4 py-3 text-gray-800 font-semibold">{{ $r['name'] }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $r['dept'] }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $r['jabatan'] }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $r['pendidikan'] }}</td>

                                {{-- Status --}}
                                <td class="px-4 py-3 text-center">
                                    @if (!$r['assessment'])
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">Belum
                                            Dinilai</span>
                                    @else
                                        @if ($r['assessment']->status === 'approved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold">DISETUJUI</span>
                                        @elseif ($r['assessment']->status === 'rejected')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold">DITOLAK</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-semibold">{{ strtoupper($r['assessment']->status) }}</span>
                                        @endif
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-3 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('performance.input', ['periodId' => $period->id, 'nik' => $r['nik']]) }}"
                                            class="inline-flex items-center gap-2 px-3 py-1 bg-blue-600 text-white rounded-md text-xs hover:bg-blue-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Isi Penilaian
                                        </a>

                                        <a href="#"
                                            class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 text-gray-800 rounded-md text-xs border border-gray-200 hover:bg-gray-50">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                    Tidak ada data karyawan untuk periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-gray-50 flex items-center justify-between">
                <div class="text-sm text-gray-500">Menampilkan {{ $rows->count() }} karyawan</div>
                <div>
                    {{-- Jika menggunakan pagination --}}
                    @if (method_exists($rows, 'links'))
                        {{ $rows->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

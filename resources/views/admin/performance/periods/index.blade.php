<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            {{-- Header --}}
            <div
                class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Pilih Periode Penilaian</h2>
                    <p class="text-sm text-gray-500 mt-1">Pilih periode untuk melihat daftar karyawan dan ringkasan
                        penilaian.</p>  
                </div>

                <div class="flex items-center gap-3">
                   <a href="{{ route('admin.performance.periods.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Periode
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6">
                @if ($periods->isEmpty())
                    <div class="rounded-md bg-red-50 border border-red-100 p-4 flex items-start gap-3">
                        <div class="text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-red-700">Periode penilaian belum dibuat</div>
                            <div class="text-sm text-red-600 mt-1">Hubungi HR untuk membuat periode terlebih dahulu atau
                                klik tombol Buat Periode.</div>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left w-24">Tahun</th>
                                    <th class="px-4 py-3 text-left">Nama</th>
                                    <th class="px-4 py-3 text-left w-56">Rentang</th>
                                    <th class="px-4 py-3 text-center w-48">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($periods as $p)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-gray-700 font-medium text-center">{{ $p->year }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-800">{{ $p->name }}</td>
                                        <td class="px-4 py-3 text-gray-600 text-center">
                                            <time datetime="{{ $p->start_date }}">{{ $p->start_date }}</time>
                                            <span class="mx-2 text-gray-300">—</span>
                                            <time datetime="{{ $p->end_date }}">{{ $p->end_date }}</time>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="/performance/{{ $p->id }}/employees"
                                                    class="inline-flex items-center gap-2 px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M7 7h10M7 11h10M7 15h10"></path>
                                                    </svg>
                                                    Pilih Karyawan
                                                </a>

                                                <a href="{{ route('summary', $p->id) }}"
                                                    class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 text-gray-800 rounded-md text-sm border border-gray-200 hover:bg-gray-50">
                                                    <svg class="w-4 h-4 text-gray-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M9 7h6"></path>
                                                    </svg>
                                                    Summary
                                                </a>
                                                <form action="{{ route('admin.performance.periods.destroy', $p->id) }}"
      method="POST"
      onsubmit="return confirm('Yakin mau hapus periode ini?')"
      style="display:inline;">
    @csrf
    @method('DELETE')
    <button class="px-3 py-2 bg-red-100 text-red-600 rounded-md hover:bg-red-200 text-sm">
        🗑️
    </button>
</form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <a href="#" class="text-sm text-gray-500 hover:underline">Lihat semua
                            periode</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

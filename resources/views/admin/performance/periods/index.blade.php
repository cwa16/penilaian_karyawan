<x-app-layout>
    <div x-data="{ open: false }">
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
    <div class="max-w-10xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            {{-- Header --}}
            <div
                class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Pilih Periode Penilaian</h2>
                    <p class="text-sm text-gray-500 mt-1">Pilih periode untuk melihat daftar karyawan dan ringkasan
                        penilaian.</p>
                </div>

                <button 
                    @click="open = true"
                    type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Periode
                </button>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6">
                @if (session('success'))
                    <div id="success-msg" class="mb-4 px-4 py-3 rounded-md bg-green-100 text-green-800">
                        {{ session('success') }}
                    </div>

                    <script>
                        setTimeout(function() {
                            const msg = document.getElementById('success-msg');
                            if(msg) msg.style.display = 'none';
                        }, 5000);
                    </script>
                @endif
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
                        <table class="min-w-full text-sm border-collapse shadow-md">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th class="px-4 py-3 text-left w-24">Tahun</th>
                                    <th class="px-4 py-3 text-left">Nama</th>
                                    <th class="px-4 py-3 text-center w-56">Rentang</th>
                                    <th class="px-4 py-3 text-center w-48">Status</th>
                                    <th class="px-4 py-3 text-center w-48">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                                @php
                                $currentYear = now()->year;
                                @endphp
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
                                            @if($p->year > $currentYear)
                                            <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">Belum Dimulai</span>
                                            @elseif($p->year == $currentYear)
                                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">Penilaian Sedang Berlangsung</span>
                                            @else
                                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">Tidak Ada Data KPI Kualitatif</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="/performance/{{ $p->id }}/employees"
                                                    class="inline-flex items-center gap-2 px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 shadow">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M7 7h10M7 11h10M7 15h10"></path>
                                                    </svg>
                                                    Pilih Karyawan
                                                </a>

                                                <a href="{{ route('summary', $p->id) }}"
                                                    class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 text-gray-800 rounded-md text-sm border border-gray-200 hover:bg-gray-50 shadow">
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
                                                    <button type="submit"
                                                        class="p-2 rounded-md bg-red-500 hover:bg-red-600 transition shadow">

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24"
                                                            class="w-5 h-5 text-white"
                                                            fill="currentColor">
                                                            <path d="M9 3h6l1 2h4v2H4V5h4l1-2zm1 6h2v8h-2V9zm4 0h2v8h-2V9zM7 9h2v8H7V9z"/>
                                                        </svg>

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
                <!-- BACKDROP -->
                <div 
                    x-show="open"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 bg-black/50 backdrop-blur-fix z-[90]"
                    @click="open = false">
                </div>

                <!-- MODAL -->
                <div 
                    x-show="open"
                    x-cloak
                    x-transition
                    class="fixed inset-0 flex items-center justify-center z-[100] p-4">

                    <div class="bg-white w-full max-w-2xl rounded-xl shadow-2xl relative">

                        <button 
                            @click="open = false"
                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                            ✕
                        </button>

                        @include('admin.performance.periods.create')

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
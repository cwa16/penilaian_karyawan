<x-app-layout>
<div id="auto-collapse-sidebar" class="hidden"></div>
<div class="max-w-full">
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">
                    Ringkasan Penilaian - {{ $period->year ?? \Carbon\Carbon::parse($period->start_date)->year }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">Rekap nilai per karyawan berdasarkan kriteria dan bobot.</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm text-slate-500">Periode:
                <time datetime="{{ $period->start_date }}">{{ $period->start_date }}</time>
                <span class="mx-2 text-gray-300">—</span>
                <time datetime="{{ $period->end_date }}">{{ $period->end_date }}</time>
                </span>

                <a href="{{ route('summary.export.excel', $period->id) }}"
                    class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"></path>
                    </svg>
                    Export
                </a>
            </div>
        </div>

        <div class="overflow-x-auto overscroll-x-contain">
            <table class="min-w-full text-sm border-collapse">
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th scope="col" rowspan="2" class="px-4 py-4 text-left font-semibold text-slate-700 w-12 ">
                            No</th>
                        <th scope="col" rowspan="2" class="px-4 py-4 text-left font-semibold text-slate-700">
                            Identitas Karyawan</th>

                        @foreach ($criteria as $c)
                            <th scope="col" colspan="3" class="px-4 py-3 text-center border-l border-slate-200">
                                <div class="flex flex-col items-center">
                                    <span
                                        class="block text-slate-900 uppercase tracking-wider text-xs">{{ $c->name }}</span>
                                    <span
                                        class="mt-1 inline-flex items-center text-[11px] font-medium text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded-full">
                                        Bobot {{ $c->weight }}%
                                    </span>
                                </div>
                            </th>
                        @endforeach

                        <th scope="col" rowspan="2"
                            class="px-6 py-4 text-center font-bold text-slate-900 bg-slate-100/50 border-l border-slate-200 w-28"
                            aria-label="Total skor">TOTAL</th>
                    </tr>

                    <tr class="bg-slate-50/50 border-b border-slate-200">
                        @foreach ($criteria as $c)
                            <th
                                class="px-2 py-2 text-[11px] font-medium text-slate-500 text-center border-l border-slate-200">
                                N1</th>
                            <th class="px-2 py-2 text-[11px] font-medium text-slate-500 text-center">N2</th>
                            <th class="px-2 py-2 text-[11px] font-semibold text-indigo-700 text-center bg-indigo-50/30">
                                SKOR</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach ($summary as $i => $s)
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="px-4 py-4 text-slate-500 text-center">{{ $i + 1 }}</td>

                            <td class="px-4 py-4">
                                <div class="font-medium text-slate-900">{{ $s['name'] }}</div>
                                <div class="text-xs text-slate-400">{{ $s['nik'] }}</div>
                                @if (!empty($s['meta']))
                                    <div class="text-xs text-slate-400 mt-1">{{ $s['meta'] }}</div>
                                @endif
                            </td>

                            @foreach ($criteria as $c)
                                <td class="px-2 py-4 text-center text-slate-600 border-l border-slate-50">
                                    {{ $s['rows'][$c->id]['nilai1'] ?? '-' }}</td>
                                <td class="px-2 py-4 text-center text-slate-600">
                                    {{ $s['rows'][$c->id]['nilai2'] ?? '-' }}</td>
                                <td
                                    class="px-2 py-4 text-center font-medium text-indigo-600 bg-indigo-50/20 border-r border-slate-50">
                                    {{ number_format($s['rows'][$c->id]['skor'] ?? 0, 2) }}
                                </td>
                            @endforeach

                            <td class="px-6 py-4 text-center font-bold text-slate-900 bg-slate-50/50">
                                <span
                                    class="inline-block px-3 py-1 rounded-md bg-white border border-slate-200 shadow-sm">
                                    {{ number_format($s['total'] ?? 0, 2) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-3 border-t border-slate-100 flex items-center justify-between">
            <div class="text-sm text-slate-500">Menampilkan {{ count($summary) }} hasil</div>
            <div class="text-sm">
                {{-- Jika menggunakan pagination, ganti dengan links --}}
                {{-- {{ $summary->links() }} --}}

            <a href="{{ route('admin.performance.periods.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm border border-gray-200 hover:bg-gray-50">
    
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
                </svg>

                Kembali Ke Periode
            </a>

            </div>
        </div>
    </div>

</x-app-layout>

<x-app-layout>
    <div class="overflow rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th rowspan="2" class="px-4 py-4 font-semibold text-slate-700">No</th>
                    <th rowspan="2" class="px-4 py-4 font-semibold text-slate-700">Identitas Karyawan</th>

                    @foreach ($criteria as $c)
                        <th colspan="3" class="px-4 py-3 text-center border-l border-slate-200">
                            <span
                                class="block text-slate-900 uppercase tracking-wider text-xs">{{ $c->name }}</span>
                            <span
                                class="text-[10px] font-medium text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full mt-1 inline-block">
                                W: {{ $c->weight }}%
                            </span>
                        </th>
                    @endforeach

                    <th rowspan="2"
                        class="px-6 py-4 font-bold text-slate-900 bg-slate-100/50 text-center border-l border-slate-200">
                        TOTAL
                    </th>
                </tr>

                <tr class="bg-slate-50/50 border-b border-slate-200">
                    @foreach ($criteria as $c)
                        <th
                            class="px-2 py-2 text-[11px] font-medium text-slate-500 text-center border-l border-slate-200">
                            N1</th>
                        <th class="px-2 py-2 text-[11px] font-medium text-slate-500 text-center">N2</th>
                        <th class="px-2 py-2 text-[11px] font-semibold text-indigo-700 text-center bg-indigo-50/30">
                            SKOR
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @foreach ($summary as $i => $s)
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="px-4 py-4 text-slate-500">{{ $i + 1 }}</td>
                        <td class="px-4 py-4">
                            <div class="font-medium text-slate-900">{{ $s['name'] }}</div>
                            <div class="text-xs text-slate-400">{{ $s['nik'] }}</div>
                        </td>

                        @foreach ($criteria as $c)
                            <td class="px-2 py-4 text-center text-slate-600 border-l border-slate-50">
                                {{ $s['rows'][$c->id]['nilai1'] }}
                            </td>
                            <td class="px-2 py-4 text-center text-slate-600">
                                {{ $s['rows'][$c->id]['nilai2'] }}
                            </td>
                            <td
                                class="px-2 py-4 text-center font-medium text-indigo-600 bg-indigo-50/20 border-r border-slate-50">
                                {{ number_format($s['rows'][$c->id]['skor'], 2) }}
                            </td>
                        @endforeach

                        <td class="px-6 py-4 text-center font-bold text-slate-900 bg-slate-50/50">
                            <span class="inline-block px-3 py-1 rounded-md bg-white border border-slate-200 shadow-sm">
                                {{ number_format($s['total'], 2) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>

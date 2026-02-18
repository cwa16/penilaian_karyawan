<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Penilaian Karyawan</h2>

                    <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-1 text-xs">
                        <div>
                            <p class="text-gray-400 uppercase tracking-wide">NIK</p>
                            <p class="font-semibold text-gray-800">{{ $user->nik ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400 uppercase tracking-wide">Nama</p>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400 uppercase tracking-wide">Dept</p>
                            <p class="font-semibold text-gray-800">{{ $user->dept ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400 uppercase tracking-wide">Jabatan</p>
                            <p class="font-semibold text-gray-800">{{ $user->jabatan ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-end gap-2">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center gap-2 px-3 py-1.5 border border-gray-200 rounded-md text-xs text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali
                    </a>

                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-gray-500">Status</span>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full font-semibold
                            {{ $assessment->status == 'approved'
                                ? 'bg-green-50 text-green-700'
                                : ($assessment->status == 'rejected'
                                    ? 'bg-red-50 text-red-700'
                                    : 'bg-yellow-50 text-yellow-700') }}">
                            {{ strtoupper($assessment->status) }}
                        </span>

                        <span class="text-gray-300">|</span>

                      @if ($evaluatorOrder == 1)
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded">
                            Anda mengisi sebagai Evaluator 1
                        </span>
                    @else
                        <span class="text-xs text-green-700 bg-green-50 px-2 py-1 rounded">
                            Anda mengisi sebagai Evaluator 2
                        </span>
                    @endif

                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-4">

                <!-- @if (session('success'))
                    <div class="mb-3 p-2 bg-green-50 border border-green-200 text-green-800 rounded-md text-xs">
                        {{ session('success') }}
                    </div>
                @endif -->

                <form method="POST" action="/performance/input/save">
                    @csrf
                    <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">

                    {{-- Keterangan Nilai --}}
                    <div class="mb-3 px-4 py-2 bg-gray-50 border border-gray-200 rounded-md text-xs text-gray-600">
                        <div class="flex flex-wrap gap-x-3 gap-y-1">
                            <span><strong>1</strong> Kurang (B-)</span>
                            <span>|</span>
                            <span><strong>2</strong> Cukup (B)</span>
                            <span>|</span>
                            <span><strong>3</strong> Baik (B+)</span>
                            <span>|</span>
                            <span><strong>4</strong> Sangat Baik (A)</span>
                            <span>|</span>
                            <span><strong>5</strong> Sempurna (S)</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-xs">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="px-3 py-2 w-12 text-left">No</th>
                                    <th class="px-3 py-2 text-left">Name</th>
                                    <th class="px-3 py-2 text-left">Description</th>
                                    <th class="px-3 py-2 text-center w-20">Bobot</th>
                                    <th class="px-3 py-2 text-center w-20">Nilai 1</th>
                                    <th class="px-3 py-2 text-center w-20">Nilai 2</th>
                                    <th class="px-3 py-2 text-center w-20">Skor</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                                @php $total = 0; @endphp

                                @foreach ($criteria as $i => $c)
                                    @php
                                        $nilai1 = $scores[$c->id][1] ?? 0;
                                        $nilai2 = $scores[$c->id][2] ?? 0;
                                        $avg = $nilai1 == 0 ? $nilai2 : ($nilai1 + $nilai2) / 2;
                                        $score = ($avg * $c->weight) / 100;
                                        $total += $score;
                                    @endphp

                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 text-center text-gray-600">{{ $i + 1 }}</td>
                                        <td class="px-3 py-2 font-medium text-gray-800">{{ $c->name }}</td>
                                        <td class="px-3 py-2 text-gray-500">{{ $c->description }}</td>

                                        <td class="px-3 py-2 text-center text-gray-700">
                                            {{ number_format($c->weight, 0) }}%
                                        </td>

                                        <td class="px-3 py-2">
                                            <input type="number" min="1" max="5"
                                                name="scores[{{ $c->id }}][1]" value="{{ $nilai1 }}"
                                                {{ $evaluatorOrder != 1 ? 'readonly' : '' }}
                                                class="w-full text-center border rounded-md px-2 py-1 text-xs
                                                {{ $evaluatorOrder == 1
                                                    ? 'bg-white border-gray-300 focus:ring-2 focus:ring-blue-200'
                                                    : 'bg-gray-50 border-gray-100 text-gray-400 cursor-not-allowed' }}">
                                        </td>

                                        <td class="px-3 py-2">
                                            <input type="number" min="1" max="5"
                                                name="scores[{{ $c->id }}][2]" value="{{ $nilai2 }}"
                                                {{ $evaluatorOrder != 2 ? 'readonly' : '' }}
                                                class="w-full text-center border rounded-md px-2 py-1 text-xs
                                                {{ $evaluatorOrder == 2
                                                    ? 'bg-white border-gray-300 focus:ring-2 focus:ring-green-200'
                                                    : 'bg-gray-50 border-gray-100 text-gray-400 cursor-not-allowed' }}">
                                        </td>


                                        <td class="px-3 py-2 text-center font-semibold text-gray-800">
                                            {{ number_format($score, 2) }}
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="bg-gray-50">
                                    <td colspan="4" class="px-3 py-2 text-right font-medium text-gray-600">
                                        TOTAL SKOR
                                    </td>
                                    <td colspan="3" class="px-3 py-2 text-right text-base font-bold text-gray-900">
                                        {{ number_format($total, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

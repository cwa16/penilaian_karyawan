<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Performance Assessment</h2>
                <p class="text-sm text-gray-600">
                    Karyawan: <b>{{ $user->name }}</b>
                </p>
            </div>
            <div class="text-sm">
                Status:
                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700">
                    {{ strtoupper($assessment->status) }}
                </span>
            </div>
            @if ($slot === 1)
                <span class="text-sm text-blue-600 font-semibold">
                    Anda mengisi sebagai Penilai 1
                </span>
            @else
                <span class="text-sm text-green-600 font-semibold">
                    Anda mengisi sebagai Penilai 2
                </span>
            @endif
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-3 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/performance/input/save">
            @csrf
            <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-800 text-white sticky top-0">
                        <tr>
                            <th class="border px-2 py-2 w-12">No</th>
                            <th class="border px-2 py-2">Kriteria</th>
                            <th class="border px-2 py-2 w-28">Bobot (%)</th>
                            <th class="border px-2 py-2 w-24">Nilai</th>
                            <th class="border px-2 py-2 w-24">Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($criteria as $i => $c)
                            @php
                                $val = $scores[$c->id] ?? 0;
                                $score = ($val * $c->weight) / 100;
                                $total += $score;
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="border px-2 py-2 text-center">{{ $i + 1 }}</td>
                                <td class="border px-2 py-2">{{ $c->name }}</td>
                                <td class="border px-2 py-2 text-center">{{ $c->weight }}</td>
                                <td class="border px-2 py-2">
                                    <input type="number" min="1" max="5" step="1"
                                        name="scores[{{ $c->id }}]" value="{{ $val }}"
                                        class="score-input w-full text-center border rounded py-1 bg-yellow-50 focus:ring focus:ring-blue-300"
                                        data-weight="{{ $c->weight }}">
                                </td>
                                <td class="border px-2 py-2 text-center score-cell">
                                    {{ number_format($score, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-100 font-semibold">
                        <tr>
                            <td colspan="4" class="border px-2 py-2 text-right">
                                TOTAL SKOR
                            </td>
                            <td class="border px-2 py-2 text-center" id="totalScore">
                                {{ number_format($total, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Action --}}
            <div class="mt-4 flex justify-end gap-2">
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- Auto Calculate --}}
    <script>
        document.querySelectorAll('.score-input').forEach(input => {
            input.addEventListener('input', () => {
                let row = input.closest('tr');
                let weight = parseFloat(input.dataset.weight);
                let val = parseFloat(input.value) || 0;

                if (val < 1 || val > 5) {
                    input.classList.add('border-red-500');
                    return;
                } else {
                    input.classList.remove('border-red-500');
                }

                let score = (val * weight) / 100;
                row.querySelector('.score-cell').innerText = score.toFixed(2);

                let total = 0;
                document.querySelectorAll('.score-cell').forEach(cell => {
                    total += parseFloat(cell.innerText) || 0;
                });
                document.getElementById('totalScore').innerText = total.toFixed(2);
            });
        });
    </script>
</x-app-layout>

<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">

        <h2 class="text-xl font-semibold mb-4">
            Pilih Periode Penilaian
        </h2>

        @if ($periods->isEmpty())
            <div class="p-4 bg-red-100 text-red-700 rounded">
                ⚠️ Periode penilaian belum dibuat.
                <br>
                Hubungi HR untuk membuat periode terlebih dahulu.
            </div>
        @else
            <table class="w-full border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border px-3 py-2">Tahun</th>
                        <th class="border px-3 py-2">Nama</th>
                        <th class="border px-3 py-2">Rentang</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periods as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $p->year }}</td>
                            <td class="border px-3 py-2">{{ $p->name }}</td>
                            <td class="border px-3 py-2 text-center">
                                {{ $p->start_date }} – {{ $p->end_date }}
                            </td>
                            <td class="border px-3 py-2 text-center">
                                <a href="/performance/{{ $p->id }}/employees"
                                    class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                                    Pilih Karyawan
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</x-app-layout>

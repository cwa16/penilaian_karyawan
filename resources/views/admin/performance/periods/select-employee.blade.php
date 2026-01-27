<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-4">
            <h2 class="text-xl font-semibold">
                Pilih Karyawan – {{ $period->name }}
            </h2>
            <p class="text-sm text-gray-600">
                Periode: {{ $period->start_date }} s/d {{ $period->end_date }}
            </p>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="w-full text-sm border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">NIK</th>
                        <th class="border px-3 py-2">Nama</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2">Dept.</th>
                        <th class="border px-3 py-2">Jabatan</th>
                        <th class="border px-3 py-2">Pendidikan</th>
                        <th class="border px-3 py-2">Penilai 1</th>
                        <th class="border px-3 py-2">Penilai 2</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $i => $r)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $i + 1 }}</td>
                            <td class="border px-3 py-2">{{ $r['nik'] }}</td>
                            <td class="border px-3 py-2 font-medium">{{ $r['name'] }}</td>
                            <td class="border px-3 py-2">{{ $r['status'] }}</td>
                            <td class="border px-3 py-2">{{ $r['dept'] }}</td>
                            <td class="border px-3 py-2">{{ $r['jabatan'] }}</td>
                            <td class="border px-3 py-2">{{ $r['pendidikan'] }}</td>

                            <td>
                                @forelse($r['penilai1'] as $p1)
                                    <div>{{ $p1->name }}</div>
                                @empty
                                    <span class="text-xs text-red-500">Belum ada</span>
                                @endforelse
                            </td>

                            <td>
                                @forelse($r['penilai2'] as $p2)
                                    <div>{{ $p2->name }}</div>
                                @empty
                                    <span class="text-xs text-red-500">Belum ada</span>
                                @endforelse
                            </td>



                            {{-- Status --}}
                            <td class="border px-3 py-2 text-center">
                                @if (!$r['assessment'])
                                    <span class="px-2 py-1 text-xs bg-gray-200 rounded">
                                        Belum Dinilai
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs rounded
                                {{ $r['assessment']->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ strtoupper($r['assessment']->status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="border px-3 py-2 text-center">
                                <a href="{{ route('performance.input', ['periodId' => $period->id, 'nik' => $r['nik']]) }}"
                                    class="px-3 py-1 bg-blue-600 text-white rounded text-xs">
                                    Isi Penilaian
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border px-3 py-6 text-center text-gray-500">
                                Tidak ada data karyawan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>

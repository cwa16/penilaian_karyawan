<x-app-layout>
<div class="max-w-6xl mx-auto p-6">
    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Master Criteria Penilaian</h2>
            <a href="{{ route('criteria.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
               + Tambah Criteria
            </a>
        </div>

        @if(session('success'))
            <div class="mb-3 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Kode</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Deskripsi</th>
                    <th class="p-2 border">Bobot</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($criteria as $c)
                <tr>
                    <td class="p-2 border">{{ $c->code }}</td>
                    <td class="p-2 border">{{ $c->name }}</td>
                    <td class="p-2 border">{{ $c->description }}</td>
                    <td class="p-2 border">{{ $c->weight }}%</td>
                    <td class="p-2 border">
                        <div class="flex items-center gap-2">

                     {{-- TOMBOL EDIT --}}
                          <a href="{{ route('criteria.edit', $c->id) }}"
                          class="px-3 py-2 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 text-sm"
                          title="Edit">
                            ✏️
                        </a>

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('criteria.destroy', $c->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin hapus kriteria ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-2 bg-red-100 text-red-600 rounded-md hover:bg-red-200 text-sm"
                                        title="Hapus">
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
</div>
</x-app-layout>
<x-app-layout>
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-xl font-semibold mb-4">Edit Kriteria</h2>

        <form action="{{ route('criteria.update', $criteria->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block">Kode</label>
                <input type="text" name="code" value="{{ $criteria->code }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block">Nama Kriteria</label>
                <input type="text" name="name" value="{{ $criteria->name }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2">{{ $criteria->description }}</textarea>
            </div>

            <div>
                <label class="block">Bobot (%)</label>
                <input type="number" name="weight" value="{{ $criteria->weight }}" class="w-full border rounded p-2" required>
            </div>

            <div class="flex gap-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('criteria.index') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>

    </div>
</div>
</x-app-layout>

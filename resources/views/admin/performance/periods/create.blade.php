<x-app-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">Buat Periode Penilaian</h2>

        <form action="{{ route('admin.performance.periods.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="block text-sm">Tahun</label>
                <input type="number" name="year" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm">Nama Periode</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm">Tanggal Mulai</label>
                <input type="date" name="start_date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm">Tanggal Selesai</label>
                <input type="date" name="end_date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.performance.periods.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>

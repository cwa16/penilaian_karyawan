<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        <h2 class="text-xl font-semibold mb-4">
            Setting Penilaian Manager
        </h2>

        @if (session('success'))
            <div class="mb-3 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST">
            @csrf

            <div class="bg-white shadow rounded p-4 mb-4">
                <label class="block text-sm font-medium mb-1">
                    Pilih Manager
                </label>
                <select name="manager_nik" class="w-full border rounded px-3 py-2">
                    @foreach ($managers as $m)
                        <option value="{{ $m->nik }}">
                            {{ $m->name }} ({{ $m->nik }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white shadow rounded p-4">
                <p class="text-sm font-medium mb-2">
                    Departemen yang boleh dinilai
                </p>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($departments as $dept)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="departments[]" value="{{ $dept }}">
                            <span>{{ $dept }}</span>
                        </label>
                    @endforeach
                </div>

                <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                    Simpan Setting
                </button>
            </div>
        </form>

    </div>
</x-app-layout>

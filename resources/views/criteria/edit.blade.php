<x-app-layout>
<div class="max-w-6xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            Edit Master Criteria
        </h2>

        <form action="{{ route('criteria.update', $criteria->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- ROW 1 : SECTION | KODE | NAMA --}}
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Section
                    </label>
                    <input type="text" name="section"
                        value="{{ old('section', $criteria->section) }}"
                        class="w-full border rounded-lg p-2 text-sm focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Kode
                    </label>
                    <input type="text" name="code"
                        value="{{ old('code', $criteria->code) }}"
                        class="w-full border rounded-lg p-2 text-sm focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Nama Kriteria
                    </label>
                    <input type="text" name="name"
                        value="{{ old('name', $criteria->name) }}"
                        class="w-full border rounded-lg p-2 text-sm focus:ring focus:ring-blue-200"
                        required>
                </div>
            </div>

            {{-- DEFINISI FULL WIDTH --}}
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">
                    Definisi
                </label>
                <textarea name="description"
                    rows="3"
                    class="w-full border rounded-lg p-2 text-sm focus:ring focus:ring-blue-200">{{ old('description', $criteria->description) }}</textarea>
            </div>

            {{-- KATEGORI PENILAIAN (HORIZONTAL) --}}
            <div class="border-t pt-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Kategori Penilaian (I – V)
                </h3>

                <div class="grid grid-cols-5 gap-3">
                    @for($i = 1; $i <= 5; $i++)
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1 text-center">
                                Nilai {{ $i }}
                            </label>
                            <textarea name="scales[{{ $i }}]"
                                rows="4"
                                class="w-full border rounded-lg p-2 text-xs focus:ring focus:ring-blue-200">{{ old("scales.$i", optional($criteria->scales->where('score', $i)->first())->description) }}</textarea>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 pt-6 border-t">
                <a href="{{ route('criteria.index') }}"
                   class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-700 shadow">
                    Update Data
                </button>
            </div>

        </form>

    </div>
</div>
</x-app-layout>       
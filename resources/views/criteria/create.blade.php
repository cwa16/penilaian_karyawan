<x-app-layout>
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-bold text-2xl text-center shadow-lg">
            PT. Bridgestone Kalimantan Plantation
        </h2>
    </div>
    <div class="max-w-7xl mx-auto">
        <!-- CARD -->
        <div class="bg-white shadow-lg rounded-xl px-8 py-1">

            <form action="{{ route('criteria.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- INFORMASI UTAMA -->
                <div class="mb-2">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold mt-1">
                            Tambah Criteria Penilaian
                        </h1>
                        <a href="{{ route('criteria.index') }}"
                            class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-200 rounded-md text-sm border hover:bg-gray-100 shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            Kembali
                        </a>
                    </div>
                    <p class="text-sm text-gray-500">
                        Form pembuatan aspek dan kategori penilaian Performance Appraisal (PA)
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-medium border-b pb-2 mb-4">
                        Informasi Aspek Penilaian
                    </h3>

                    <!-- SECTION (DI ATAS SENDIRI) -->
                    <!-- SECTION (DI ATAS SENDIRI) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Section</label>
                        <div class="flex gap-2">

                            <!-- DROPDOWN SECTION -->
                            <select name="section" id="section"
                                class="border rounded-lg px-3 py-1 text-sm flex-none w-60 shadow-md">

                                <option value="">-- Pilih Section --</option>

                                @foreach($sections as $section)
                                    <option value="{{ $section }}">
                                        {{ ucwords(str_replace('_',' ', $section)) }}
                                    </option>
                                @endforeach

                            </select>

                            <!-- BUTTON TAMBAH SECTION -->
                            <button type="button"
                                class="px-3 py-2 border rounded-lg text-sm bg-gray-200 hover:bg-gray-100 shadow-md"
                                onclick="addSection()">
                                + Tambah Section
                            </button>
                        </div>
                    </div>

                    <script>
                    function addSection() {
                        let newSection = prompt("Masukkan nama Section baru:");

                        if(newSection) {

                            // format jadi snake_case biar konsisten database
                            let formattedValue = newSection
                                .toLowerCase()
                                .trim()
                                .replace(/\s+/g,'_');

                            const select = document.getElementById('section');

                            // cek kalau sudah ada jangan ditambah lagi
                            let exists = false;
                            for (let i = 0; i < select.options.length; i++) {
                                if (select.options[i].value === formattedValue) {
                                    exists = true;
                                    break;
                                }
                            }

                            if (!exists) {
                                const option = document.createElement('option');
                                option.value = formattedValue;
                                option.text = newSection;
                                select.add(option);
                            }

                            select.value = formattedValue;
                        }
                    }
                    </script>
                    <!-- KODE + ASPEK PENILAIAN PA (2 KOLOM, RATAS KIRI) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Kode</label>
                            <input type="text" name="code"
                                class="w-full border rounded-lg px-3 py-1 shadow-md"
                                placeholder="Contoh: K21 dst." required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Aspek Penilaian PA</label>
                            <input type="text" name="name"
                                class="w-full border rounded-lg px-3 py-1 shadow-md"
                                placeholder="Contoh: Kuantitas (Ktt)" required>
                        </div>
                    </div>

                    <!-- DEFINISI -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Definisi</label>
                        <textarea name="definition" rows="3"
                            class="w-full border rounded-lg px-3 py-1 shadow-md"
                            placeholder="Contoh: Seberapa besar kuantitas (jumlah) hasil kerja ditinjau dari target kerja yang ditetapkan untuk ybs..."></textarea>
                    </div>

                    <script>
                    function addSection() {
                        let newSection = prompt("Masukkan nama Section baru:");
                        if(newSection) {
                            const select = document.getElementById('section');
                            const option = document.createElement('option');
                            option.value = newSection.toLowerCase().replace(/ /g,'_');
                            option.text = newSection;
                            select.add(option);
                            select.value = option.value;
                        }
                    }
                    </script>
                </div>

                <!-- KATEGORI PENILAIAN -->
                <div>
                    <h3 class="text-lg font-medium border-b pb-2 mb-4">
                        Kategori Penilaian
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                        <div>
                            <label class="block text-sm font-medium mb-1">Kurang (I)</label>
                            <textarea name="score_1" rows="4"
                                class="w-full border rounded-lg px-3 py-1 shadow-md"
                                placeholder="Kriteria penilaian tingkat Kurang"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Cukup (II)</label>
                            <textarea name="score_2" rows="4"
                                class="w-full border rounded-lg px-3 py-1 shadow-md"
                                placeholder="Kriteria penilaian tingkat Cukup"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Baik (III)</label>
                            <textarea name="score_3" rows="4"
                                class="w-full border rounded-lg px-3 py-1 shadow-md"
                                placeholder="Kriteria penilaian tingkat Baik"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Baik Sekali (IV)</label>
                            <textarea name="score_4" rows="4"
                                class="w-full border rounded-lg px-3 py-1 shadow-md"
                                placeholder="Kriteria penilaian tingkat Baik Sekali"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Istimewa (V)</label>
                            <textarea name="score_5" rows="4"
                                class="w-full border rounded-lg px-3 py-0.5 shadow-md"
                                placeholder="Kriteria penilaian tingkat Istimewa"></textarea>
                        </div>

                    </div>
                </div>

                <!-- ACTION -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('criteria.index') }}"
                        class="px-5 py-2 rounded-lg border bg-gray-200 hover:bg-gray-100 shadow-md">
                        Batal
                    </a>
                    <button
                        class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                        Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
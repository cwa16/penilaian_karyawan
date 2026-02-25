
<div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">

            <!-- HEADER -->
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-2x1 font-semibold text-gray-800">
                    Buat Periode Penilaian
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Silakan isi informasi periode Performance Appraisal (PA).
                </p>
            </div>

            <!-- FORM -->
            <form action="{{ route('admin.performance.periods.store') }}" method="POST" class="px-6 py-6 space-y-5">
                @csrf

                <!-- TAHUN -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tahun
                    </label>
                    <input type="number" name="year"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 
                            focus:border-blue-500 shadow transition"
                        required>
                </div>

                <!-- NAMA PERIODE -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Periode
                    </label>
                    <input type="text" name="name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 
                            focus:border-blue-500 shadow transition"
                        required>
                </div>

                <!-- GRID TANGGAL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Mulai
                        </label>
                        <input type="date" name="start_date"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 
                                focus:border-blue-500 shadow transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Selesai
                        </label>
                        <input type="date" name="end_date"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 
                                focus:border-blue-500 shadow transition"
                            required>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.performance.periods.index') }}"
                        class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 
                            text-gray-700 text-sm font-medium shadow transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 
                            text-white text-sm font-medium shadow transition">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
</div>

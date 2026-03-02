<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logobskp2.png') }}" 
                alt="Company Logo" 
                class="h-10 w-auto">
            
            <div>
                <h1 class="text-lg font-semibold text-gray-800 leading-tight">
                    PT. Bridgestone Kalimantan Plantation
                </h1>
                <p class="text-sm text-gray-500">
                    Performance Management System
                </p>
            </div>
        </div>
    </div>
<div class="max-w-7xl mx-auto">

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">
            Export KPI Kualitatif
        </h1>
        <div class="-mx-6 border-b border-slate-100 mt-2 mb-6"></div>
        {{-- Pilih Tahun --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Tahun Penilaian
            </label>

            <select class="mt-1 w-full border rounded-md px-3 py-2">
                <option selected>2025</option>
            </select>
        </div>

        {{-- Tombol Export --}}
        <div class="flex gap-3 pt-4">

            <button
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md shadow">
                Export PDF
            </button>

            <button
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md shadow">
                Export Excel
            </button>

        </div>

    </div>
</div>

</x-app-layout>
<x-app-layout>
    <div x-data="{ openImport:false }">
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
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">
                    KPI Kualitatif - {{ $period->year }}
                </h2>

                <a href="{{ route('kpi-kualitatif.periods') }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-md text-sm border text-gray-700 hover:bg-gray-200 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            
            {{-- IMPORT FORM --}}
            <form action="{{ route('kpi-kualitatif.import') }}" 
                method="POST" 
                enctype="multipart/form-data" 
                class="flex items-center gap-3 mb-6">
                @csrf

                <input type="file" name="file"
                    class="border border-gray-300 px-3 py-1 text-sm shadow">

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-1 text-sm rounded hover:bg-blue-700 shadow-md">
                    IMPORT
                </button>
            </form>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="overflow-x-auto">

            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        @if($kualitatifs->isNotEmpty())
                            @foreach(array_keys($kualitatifs->first()->getAttributes()) as $column)
                                <th class="border px-3 py-2">{{ Str::title(str_replace('_', ' ', $column)) }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse($kualitatifs as $item)
                        <tr class="hover:bg-gray-50">
                            @foreach($item->getAttributes() as $value)
                                <td class="border px-3 py-2 text-center">{{ $value }}</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $kualitatifs->first() ? count($kualitatifs->first()->getAttributes()) : 1 }}" class="text-center py-4 text-gray-500">
                                Belum ada data KPI
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            </table>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
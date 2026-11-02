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
<div class="max-w-7xl mx-auto py-6">
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        Pilih Periode KPI Kualitatif
    </h2>

    <a href="{{ route('admin.performance.periods.create') }}"
        class="bg-purple-600 text-white px-4 py-2 rounded shadow hover:bg-purple-700 hidden">
        + Tambah Periode
    </a>
</div>


<div class="grid grid-cols-3 gap-6">

@foreach($periods as $period)

<a 
href="{{ route('kpi-kualitatif.index', $period->id) }}"

class="bg-white p-6 rounded-xl shadow hover:shadow-lg border hover:border-blue-500 transition
{{ $period->year >= now()->year ? 'blocked-period' : '' }}"
>
    <div class="text-3xl font-bold text-gray-800">
        {{ $period->year }}
    </div>

    <div class="text-sm text-gray-500 mt-1">
        {{ $period->name }}
    </div>

    <div class="text-xs text-gray-400 mt-2">
        {{ $period->start_date }} - {{ $period->end_date }}
    </div>

    <div class="mt-4 flex gap-2">

        @if($period->canImport)

        <button class="bg-blue-600 text-white px-3 py-1 text-sm rounded shadow hover:bg-blue-700">
            Import
        </button>

        @else

        @if($period->status == 'Belum Dimulai')

        <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">
            {{ $period->status }}
        </span>

        @elseif($period->status == 'Penilaian Sedang Berlangsung')

        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">
            {{ $period->status }}
        </span>

        @elseif($period->status == 'Tidak Ada Data KPI')

        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">
            {{ $period->status }}
        </span>

        @elseif($period->status == 'Data KPI Telah Tersedia')

        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
            {{ $period->status }}
        </span>

        @endif

        @endif

    </div>
    
</a>

@endforeach

</div>

</div>
<div id="periodAlert" 
class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden z-50">

    <div class="bg-white rounded-lg shadow-lg p-6 text-center w-80">

        <h3 id="alertTitle" class="text-lg font-semibold text-gray-800 mb-2"></h3>

        <p id="alertMessage" class="text-sm text-gray-500 mb-4"></p>

        <button onclick="closeAlert()" 
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            OK
        </button>

    </div>

</div>
</x-app-layout>
<script>

document.addEventListener("DOMContentLoaded", function(){

    document.querySelectorAll('.blocked-period').forEach(function(el){

        el.addEventListener('click', function(e){

            e.preventDefault();

            const year = el.querySelector('div').innerText.trim();
            const currentYear = new Date().getFullYear();

            const title = document.getElementById("alertTitle");
            const message = document.getElementById("alertMessage");

            if(year > currentYear){

                title.innerText = "Periode Belum Dimulai";
                message.innerText = "Periode ini belum dimulai sehingga data belum dapat diakses.";

            }

            if(year == currentYear){

                title.innerText = "Penilaian Sedang Berlangsung";
                message.innerText = "Periode ini masih dalam proses penilaian sehingga data belum dapat diakses.";

            }

            document.getElementById('periodAlert').classList.remove('hidden');

        });

    });

});

function closeAlert(){
    document.getElementById('periodAlert').classList.add('hidden');
}

</script>
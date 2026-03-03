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
{{-- ================= FILTER ================= --}}
<div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
    <form action="{{ url()->current() }}" method="GET"
        class="flex flex-col md:flex-row gap-4 items-end">

        <div class="w-full md:w-1/4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Filter Dept
            </label>

            <select name="dept" onchange="this.form.submit()"
                class="w-full rounded-md border-gray-300 shadow-sm border p-2 bg-gray-50">

                <option value="">Semua Departemen</option>

                @foreach ($depts as $d)
                    <option value="{{ $d }}"
                        {{ request('dept') == $d ? 'selected' : '' }}>
                        {{ $d }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Filter Tahun
            </label>

            <select name="tahun" onchange="this.form.submit()"
                class="w-full rounded-md border-gray-300 shadow-sm border p-2 bg-gray-50">

                <option value="">Semua Tahun</option>

                @foreach ($years as $y)
                    <option value="{{ $y }}"
                        {{ request('tahun') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-auto flex gap-2">
            <a href="{{ url()->current() }}"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-sm font-medium">
                Reset
            </a>

            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition text-sm font-medium shadow">
                Cari
            </button>
        </div>

    </form>
</div>

{{-- ================= TABLE ================= --}}
<div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">

<table class="min-w-full border-collapse border border-gray-300">

<thead class="bg-gray-100 text-gray-700 text-sm uppercase font-semibold">
    <tr>
        <th rowspan="2" class="border border-gray-300 px-4 py-3 text-center align-middle">
            No
        </th>
        <th rowspan="2" class="border border-gray-300 px-4 py-3 text-center align-middle">
            NIK
        </th>
        <th rowspan="2" class="border border-gray-300 px-4 py-3 text-center align-middle">
            Nama
        </th>
        <th rowspan="2" class="border border-gray-300 px-4 py-3 text-center align-middle">
            Dept
        </th>
        <th rowspan="2" class="border border-gray-300 px-4 py-3 text-center align-middle">
            Jabatan
        </th>

        <th colspan="2" class="border border-gray-300 px-4 py-2 text-center">
            Penilai 1
        </th>

        <th colspan="2" class="border border-gray-300 px-4 py-2 text-center">
            Penilai 2
        </th>
    </tr>
    <tr>
        <th class="border border-gray-300 px-4 py-2 text-center bg-gray-200">
            Nama
        </th>
        <th class="border border-gray-300 px-4 py-2 text-center bg-gray-200">
            Ket
        </th>
        <th class="border border-gray-300 px-4 py-2 text-center bg-gray-200">
            Nama
        </th>
        <th class="border border-gray-300 px-4 py-2 text-center bg-gray-200">
            Ket
        </th>
    </tr>
</thead>

<tbody class="divide-y divide-gray-200 text-sm text-gray-700">

@forelse($data as $key => $row)
<tr class="hover:bg-gray-50 transition duration-150">

    <td class="border border-gray-300 px-4 py-3 text-center text-gray-500">
        {{ $data->firstItem() + $key }}
    </td>

    <td class="border border-gray-300 px-4 py-3 font-mono text-xs">
        {{ $row->nik }}
    </td>

    <td class="border border-gray-300 px-4 py-3 font-medium text-gray-900">
        {{ $row->name }}
    </td>

    <td class="border border-gray-300 px-4 py-3">
        {{ $row->dept }}
    </td>

    <td class="border border-gray-300 px-4 py-3">
        {{ $row->jabatan }}
    </td>

    <td class="border border-gray-300 px-4 py-3 text-gray-600">
        {{ $row->p1_name ?? '-' }}
    </td>

    <td class="border border-gray-300 px-4 py-3 text-center">
        @if(isset($row->p1_ket) && $row->p1_ket == 'OK')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                OK
            </span>
        @else
            <span class="text-gray-400">-</span>
        @endif
    </td>

    <td class="border border-gray-300 px-4 py-3 text-gray-600">
        {{ $row->p2_name ?? '-' }}
    </td>

    <td class="border border-gray-300 px-4 py-3 text-center">
        @if(isset($row->p2_ket) && $row->p2_ket == 'OK')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                OK
            </span>
        @else
            <span class="text-gray-400">-</span>
        @endif
    </td>

</tr>

@empty
<tr>
    <td colspan="9" class="border border-gray-300 px-6 py-10 text-center text-gray-500">
        Data tidak ditemukan untuk periode/departemen ini.
    </td>
</tr>
@endforelse

</tbody>
</table>
</div>

<div class="mt-4">
    {{ $data->withQueryString()->links() }}
</div>

</div>
</x-app-layout>
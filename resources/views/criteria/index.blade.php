<x-app-layout>
<div class="max-w-6xl mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-4">

        <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg font-semibold text-gray-800">Master Criteria Penilaian</h2>
            <a href="{{ route('criteria.create') }}"
               class="bg-blue-600 text-white px-3 py-1.5 text-xs rounded hover:bg-blue-700">
               + Tambah
            </a>
        </div>

        @if(session('success'))
            <div class="mb-2 text-green-600 text-xs font-medium">
                {{ session('success') }}
            </div>
        @endif

      <div class="overflow-x-auto">
    <table class="w-full border text-xs">
       <thead class="bg-gray-100">
<tr>
    <th class="p-2 border text-center w-12">Kode</th>
    <th class="p-2 border text-left w-48">Aspek Penilaian</th>
    <th class="p-2 border text-left">Definisi</th>

    {{-- KATEGORI PENILAIAN --}}
    <th class="p-2 border text-center w-16">I</th>
    <th class="p-2 border text-center w-16">II</th>
    <th class="p-2 border text-center w-16">III</th>
    <th class="p-2 border text-center w-16">IV</th>
    <th class="p-2 border text-center w-16">V</th>

    <th class="p-2 border text-center w-20">Bobot</th>
    <th class="p-2 border text-center w-24">Aksi</th>
</tr>

<tr class="bg-gray-50 text-xs">
    <th colspan="3" class="border"></th>
    <th class="border text-center">Kurang</th>
    <th class="border text-center">Cukup</th>
    <th class="border text-center">Baik</th>
    <th class="border text-center">Baik Sekali</th>
    <th class="border text-center">Istimewa</th>
    <th colspan="2" class="border"></th>
</tr>
</thead>


        <tbody>

        @php $currentSection = null; @endphp

        @foreach($criteria as $c)

            {{-- HEADER SECTION --}}
            @if($currentSection != $c->section)
                <tr class="bg-gray-200">
                    <td colspan="5" class="p-2 font-bold text-sm text-gray-800">
                        {{ $c->section }}
                    </td>
                </tr>
                @php $currentSection = $c->section; @endphp
            @endif

            <tr class="hover:bg-gray-50">
                <td class="p-2 border text-xs">
                {{ $c->scaleDescriptions->where('scale', 1)->first()->description ?? '-' }}
            </td>

            <td class="p-2 border text-xs">
                {{ $c->scaleDescriptions->where('scale', 2)->first()->description ?? '-' }}
            </td>

            <td class="p-2 border text-xs">
                {{ $c->scaleDescriptions->where('scale', 3)->first()->description ?? '-' }}
            </td>

            <td class="p-2 border text-xs">
                {{ $c->scaleDescriptions->where('scale', 4)->first()->description ?? '-' }}
            </td>

            <td class="p-2 border text-xs">
                {{ $c->scaleDescriptions->where('scale', 5)->first()->description ?? '-' }}
            </td>



                <td class="p-2 border text-center font-semibold">
                    {{ $c->code }}
                </td>

                <td class="p-2 border font-medium">
                    {{ $c->name }}
                </td>

                <td class="p-2 border text-gray-600 whitespace-normal break-words">
                    {{ $c->description }}
                </td>

                <td class="p-2 border text-center">
                    {{ $c->weight }}%
                </td>

                <td class="p-2 border text-center">
                    <div class="flex justify-center gap-1">
                        <a href="{{ route('criteria.edit', $c->id) }}"
                           class="px-2 py-1 text-xs bg-blue-50 text-blue-600 rounded hover:bg-blue-100">
                            Edit
                        </a>

                        <form action="{{ route('criteria.destroy', $c->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-2 py-1 text-xs bg-red-50 text-red-600 rounded hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>

    </div>
</div>
</x-app-layout>

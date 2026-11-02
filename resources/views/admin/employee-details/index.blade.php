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

    <!-- FILTER -->
    <div class="bg-white p-3 rounded-lg shadow mb-4 flex gap-3">
        <form method="GET" class="flex gap-3 w-full text-sm">

            <select name="status" onchange="this.form.submit()" class="border rounded px-3 py-1">
                <option value="">Semua Status</option>
                @foreach ($allStatus as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>

            <select name="dept" onchange="this.form.submit()" class="border rounded px-3 py-1">
                <option value="">Semua Dept</option>
                @foreach ($allDept as $d)
                    <option value="{{ $d }}" {{ request('dept') == $d ? 'selected' : '' }}>
                        {{ $d }}
                    </option>
                @endforeach
            </select>

            <select name="jabatan" onchange="this.form.submit()" class="border rounded px-3 py-1">
                <option value="">Semua Jabatan</option>
                @foreach ($allJabatan as $j)
                    <option value="{{ $j }}" {{ request('jabatan') == $j ? 'selected' : '' }}>
                        {{ $j }}
                    </option>
                @endforeach
            </select>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama karyawan..."
                class="border rounded px-3 py-1 w-full"
            >
        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-semibold mb-3">Daftar Karyawan</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-gray-200 text-[10px] uppercase">
                    <tr>
                        <th class="px-2 py-1 border">NIK</th>
                        <th class="px-2 py-1 border">Nama</th>
                        <th class="px-2 py-1 border">Status</th>
                        <th class="px-2 py-1 border">Dept</th>
                        <th class="px-2 py-1 border">Jabatan</th>
                        <th class="px-2 py-1 border">Pendidikan</th>
                        <th class="px-2 py-1 border text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($employees as $emp)
                        <tr class="hover:bg-gray-50 h-8 text-xs">
                            <td class="px-2 py-0.5 border text-center">{{ $emp->nik }}</td>
                            <td class="px-2 py-0.5 border font-medium">{{ $emp->name }}</td>
                            <td class="px-2 py-0.5 border">{{ $emp->status }}</td>
                            <td class="px-2 py-0.5 border">{{ $emp->dept }}</td>
                            <td class="px-2 py-0.5 border">{{ $emp->jabatan }}</td>
                            <td class="px-2 py-0.5 border">{{ $emp->pendidikan }}</td>
                            <td class="px-2 py-0.5 border text-center">
                                <a href="{{ route('employee-details.detail', $emp->id) }}"
                                class="bg-blue-600 text-white px-2 py-0.5 rounded text-xs hover:bg-blue-700">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500 text-sm">
                                Data karyawan tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
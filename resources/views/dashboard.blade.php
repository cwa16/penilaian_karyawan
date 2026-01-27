<x-app-layout>


    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-gray-600">Welcome, {{ auth()->user()->name }}</p>
    </div>

    <!-- FILTER -->
    <div class="bg-white p-4 rounded-lg shadow mb-6 flex gap-4">
        <form method="GET" class="flex gap-4 w-full">

            <!-- STATUS -->
            <select name="status" onchange="this.form.submit()" class="border rounded px-4 py-2">
                <option value="">Semua Status</option>
                @foreach ($allStatus as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>

            <!-- BIDANG / DEPT -->
            <select name="dept" onchange="this.form.submit()" class="border rounded px-4 py-2">
                <option value="">Semua Bidang</option>
                @foreach ($allDept as $d)
                    <option value="{{ $d }}" {{ request('dept') == $d ? 'selected' : '' }}>
                        {{ $d }}
                    </option>
                @endforeach
            </select>

            <!-- JABATAN -->
            <select name="jabatan" onchange="this.form.submit()" class="border rounded px-4 py-2">
                <option value="">Semua Jabatan</option>
                @foreach ($allJabatan as $j)
                    <option value="{{ $j }}" {{ request('jabatan') == $j ? 'selected' : '' }}>
                        {{ $j }}
                    </option>
                @endforeach
            </select>

            <!-- SEARCH -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama karyawan..."
                class="border rounded px-4 py-2 w-full">
        </form>
    </div>

    <!-- UPLOAD CSV -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        @if (session('success'))
            <p class="text-green-600 mb-2">{{ session('success') }}</p>
        @endif

        <form action="/import-csv" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
            @csrf
            <input type="file" name="file" accept=".csv" required class="border rounded px-2 py-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                Upload CSV
            </button>
        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Data Karyawan</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">NIK</th>
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Status</th>
                        <th class="p-3 border">Bidang</th>
                        <th class="p-3 border">Jabatan</th>
                        <th class="p-3 border">Pendidikan</th>
                        <th class="p-3 border text-center">Penilai</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($employees as $emp)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $emp->nik }}</td>
                            <td class="p-3 border font-medium">{{ $emp->name }}</td>
                            <td class="p-3 border">{{ $emp->status }}</td>
                            <td class="p-3 border">{{ $emp->dept }}</td>
                            <td class="p-3 border">{{ $emp->jabatan }}</td>
                            <td class="p-3 border">{{ $emp->pendidikan }}</td>
                            <td class="p-3 border text-center">
                                <button onclick="alert('Fitur penilaian akan segera tersedia')"
                                    class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">
                                    Nilai
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-500">
                                Data karyawan tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>

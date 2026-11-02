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
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Karyawan</h2>

            {{-- Search --}}
            <form method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK / Nama..."
                    class="border rounded px-3 py-2 text-sm">
            </form>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="w-full text-sm border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">NIK</th>
                        <th class="border px-3 py-2">Nama</th>
                        <th class="border px-3 py-2">Email</th>
                        <th class="border px-3 py-2">Role</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $i => $emp)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">
                                {{ $employees->firstItem() + $i }}
                            </td>
                            <td class="border px-3 py-2">{{ $emp->nik }}</td>
                            <td class="border px-3 py-2 font-medium">{{ $emp->name }}</td>
                            <td class="border px-3 py-2">{{ $emp->email }}</td>
                            <td class="border px-3 py-2 text-center">
                                <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                    {{ strtoupper($emp->role ?? '-') }}
                                </span>
                            </td>
                            <td class="border px-3 py-2 text-center space-x-1">
                                <a href="{{ route('employees.show', $emp->id) }}"
                                    class="px-2 py-1 text-xs bg-blue-600 text-white rounded">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-3 py-6 text-center text-gray-500">
                                Data karyawan tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $employees->links() }}
        </div>

    </div>
</x-app-layout>

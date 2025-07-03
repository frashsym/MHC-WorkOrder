<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Tugas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Tugas</h3>
                    <a href="{{ route('tugas.create') }}"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Tambah Tugas</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-500 text-white rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table
                        class="min-w-full border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">No</th>
                                <th class="px-4 py-2 text-left">Judul</th>
                                <th class="px-4 py-2 text-left">Deskripsi</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Prioritas</th>
                                <th class="px-4 py-2 text-left">Tanggal Batas</th>
                                <th class="px-4 py-2 text-left">Dibuat Oleh</th> <!-- Tambahan -->
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white">
                            @forelse ($tugas as $key => $tugasItem)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-2">{{ $tugas->firstItem() + $key }}</td>
                                    <td class="px-4 py-2">{{ $tugasItem->judul }}</td>
                                    <td class="px-4 py-2">{{ Str::limit($tugasItem->deskripsi, 50) }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($tugasItem->status) }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($tugasItem->prioritas) }}</td>
                                    <td class="px-4 py-2">
                                        {{ $tugasItem->tanggal_batas ? \Carbon\Carbon::parse($tugasItem->tanggal_batas)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2">{{ $tugasItem->user->name }}</td>
                                    <!-- Menampilkan nama pembuat tugas -->
                                    <td class="px-4 py-2 flex space-x-2">
                                        @if (auth()->id() === $tugasItem->user_id)
                                            <a href="{{ route('tugas.show', $tugasItem->id) }}"
                                                class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Lihat</a>
                                            <a href="{{ route('tugas.edit', $tugasItem->id) }}"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                            <a href="{{ route('tugas.confirm', $tugasItem->id) }}"
                                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</a>
                                        @else
                                        <a href="{{ route('tugas.show', $tugasItem->id) }}"
                                            class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Lihat</a>
                                            <span class="px-2 py-1 bg-gray-500 text-white rounded">Akses ditutup</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada tugas tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $tugas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

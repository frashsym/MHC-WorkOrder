<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Judul</th>
                <th class="px-4 py-2 text-left">Nomor Surat</th>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Departemen</th>
                <th class="px-4 py-2 text-left">Solver</th>
                <th class="px-4 py-2 text-left">Kategori</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white">
            @forelse ($orders as $key => $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-4 py-2">
                        @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $orders->firstItem() + $key }}
                        @else
                            {{ $key + 1 }}
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $order->title }}</td>
                    <td class="px-4 py-2">{{ $order->letter_number }}</td>
                    <td class="px-4 py-2">{{ $order->create_date ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->department->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->picUser->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <!-- Tombol Info -->
                        <a href="{{ route('order.show', $order->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm text-blue-600 bg-blue-100 hover:bg-blue-200 rounded">
                            <i class="fas fa-info-circle mr-1"></i> Info
                        </a>
                        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                            <!-- Tombol Edit -->
                            <button @click="openEdit({{ $order }})"
                                class="inline-flex items-center px-2 py-1 text-sm text-yellow-600 bg-yellow-100 hover:bg-yellow-200 rounded">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>

                            <!-- Tombol Delete -->
                            <button type="button" @click="deleteModal = true; deleteId = {{ $order->id }}"
                                class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-100 hover:bg-red-200 rounded">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada order tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

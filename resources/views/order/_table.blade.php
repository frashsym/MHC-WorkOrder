<div class="w-full overflow-x-auto">
    <table
        class="w-full table-auto border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-gray-200 text-sm">
        <thead class="hidden md:table-header-group bg-gray-100 dark:bg-gray-700">
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
        <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
            @forelse ($orders as $key => $order)
                <tr class="flex flex-col md:table-row hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">No:</span>
                        @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $orders->firstItem() + $key }}
                        @else
                            {{ $key + 1 }}
                        @endif
                    </td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Judul:</span> {{ $order->title }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span class="md:hidden font-semibold">Nomor
                            Surat:</span> {{ $order->letter_number }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Tanggal:</span> {{ $order->create_date ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Departemen:</span> {{ $order->department->name ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Solver:</span> {{ $order->picUser->name ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Kategori:</span> {{ $order->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell space-x-2">
                        <a href="{{ route('order.show', $order->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 rounded">
                            <i class="fas fa-info-circle mr-1"></i> Info
                        </a>
                        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                            <button @click="openEdit({{ $order }})"
                                class="inline-flex items-center px-2 py-1 text-sm text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900 hover:bg-yellow-200 dark:hover:bg-yellow-800 rounded">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button type="button" @click="deleteModal = true; deleteId = {{ $order->id }}"
                                class="inline-flex items-center px-2 py-1 text-sm text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 rounded">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada order tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

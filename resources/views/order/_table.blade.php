<div class="w-full overflow-x-auto mt-4">
    <table
        class="w-full min-w-[800px] md:min-w-full border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700 text-xs md:text-sm lg:text-base">
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs md:text-sm lg:text-base">
            <tr>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">No</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Judul</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Nomor Surat</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Tanggal</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Departemen</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Solver</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Kategori</th>
                <th class="px-2 md:px-4 py-1 md:py-2 text-left whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody
            class="divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white text-xs md:text-sm lg:text-base">
            @forelse ($orders as $key => $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">
                        @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $orders->firstItem() + $key }}
                        @else
                            {{ $key + 1 }}
                        @endif
                    </td>
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">{{ $order->title }}</td>
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">{{ $order->letter_number }}</td>
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">{{ $order->create_date ?? '-' }}</td>
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">{{ $order->department->name ?? '-' }}</td>
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">{{ $order->picUser->name ?? '-' }}</td>
                    <td class="px-2 md:px-4 py-1 md:py-2 whitespace-nowrap">{{ $order->category->name ?? '-' }}</td>
                    <td class="px-2 md:px-4 py-1 md:py-2 space-x-1 md:space-x-2 whitespace-nowrap">
                        <a href="{{ route('order.show', $order->id) }}"
                            class="inline-flex items-center px-2 py-1 text-xs md:text-sm text-blue-600 bg-blue-100 hover:bg-blue-200 rounded">
                            <i class="fas fa-info-circle mr-1"></i> Info
                        </a>
                        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                            <button @click="openEdit({{ $order }})"
                                class="inline-flex items-center px-2 py-1 text-xs md:text-sm text-yellow-600 bg-yellow-100 hover:bg-yellow-200 rounded">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button type="button" @click="deleteModal = true; deleteId = {{ $order->id }}"
                                class="inline-flex items-center px-2 py-1 text-xs md:text-sm text-red-600 bg-red-100 hover:bg-red-200 rounded">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10"
                        class="px-2 md:px-4 py-2 text-center text-gray-500 dark:text-gray-400 text-xs md:text-sm">
                        Tidak ada order tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

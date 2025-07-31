<div class="w-full overflow-x-auto mt-6">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Daftar Order</h3>
    <table
        class="w-full table-auto border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white text-sm">
        <thead class="hidden md:table-header-group bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Judul</th>
                <th class="px-4 py-2 text-left">Nomor Order</th>
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
                        {{ $key + 1 }}
                    </td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Judul:</span> {{ $order->title }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span class="md:hidden font-semibold">Nomor
                            Order:</span> {{ $order->letter_number }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Tanggal:</span> {{ $order->create_date ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Departemen:</span> {{ $order->department->name ?? '-' }}
                    </td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Solver:</span> {{ $order->picUser->name ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell"><span
                            class="md:hidden font-semibold">Kategori:</span> {{ $order->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 md:whitespace-nowrap md:table-cell">
                        <a href="{{ route('order.show', $order->id) }}"
                            class="inline-flex items-center px-2 py-1 text-sm text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 rounded">
                            <i class="fas fa-info-circle mr-1"></i> Info
                        </a>
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

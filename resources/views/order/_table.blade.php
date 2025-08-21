<!-- Wrapper responsif -->
<div class="w-full">
    <!-- Tabel (desktop ≥ 1024px) -->
    <div class="hidden lg:block overflow-x-auto">
        <table
            class="w-full table-auto border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-gray-200 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Nomor Order</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Departemen</th>
                    <th class="px-4 py-2 text-left">Solver</th>
                    <th class="px-4 py-2 text-left">Objek</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                @foreach ($orders as $key => $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-4 py-2">
                            {{ $orders instanceof \Illuminate\Pagination\LengthAwarePaginator ? $orders->firstItem() + $key : $key + 1 }}
                        </td>
                        <td class="px-4 py-2">{{ $order->title }}</td>
                        <td class="px-4 py-2">{{ $order->letter_number }}</td>
                        <td class="px-4 py-2">{{ $order->create_date ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $order->department->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $order->picUser->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $order->item->name ?? '-' }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('order.show', $order->id) }}"
                                class="inline-flex items-center px-2 py-1 text-sm text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 rounded">
                                <i class="fas fa-info-circle mr-1"></i> Info
                            </a>
                            @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2 || Auth::user()->role_id != 5)
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
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Card Grid (khusus mobile & tablet < 1024px) -->
    <div class="block lg:hidden mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach ($orders as $key => $order)
            <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 text-gray-800 dark:text-gray-200">
                <p><strong>No:</strong>
                    {{ $orders instanceof \Illuminate\Pagination\LengthAwarePaginator ? $orders->firstItem() + $key : $key + 1 }}
                </p>
                <p><strong>Judul:</strong> {{ $order->title }}</p>
                <p><strong>Nomor Order:</strong> {{ $order->letter_number }}</p>
                <p><strong>Tanggal:</strong> {{ $order->create_date ?? '-' }}</p>
                <p><strong>Departemen:</strong> {{ $order->department->name ?? '-' }}</p>
                <p><strong>Solver:</strong> {{ $order->picUser->name ?? '-' }}</p>
                <p><strong>Objek:</strong> {{ $order->item->name ?? '-' }}</p>
                <div class="flex flex-wrap gap-2 mt-3">
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
                </div>
            </div>
        @endforeach
    </div>
</div>

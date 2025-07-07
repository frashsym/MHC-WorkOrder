<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Order') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Order</h3>
                    <button onclick="document.getElementById('modal-tambah-order').classList.remove('hidden')"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                        + Tambah Order
                    </button>
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
                                <th class="px-4 py-2 text-left">Objek</th>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Waktu</th>
                                <th class="px-4 py-2 text-left">Departemen</th>
                                <th class="px-4 py-2 text-left">Kategori</th>
                                <th class="px-4 py-2 text-left">Progress</th>
                                <th class="px-4 py-2 text-left">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white">
                            @forelse ($orders as $key => $order)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-2">{{ $orders->firstItem() + $key }}</td>
                                    <td class="px-4 py-2">{{ $order->title }}</td>
                                    <td class="px-4 py-2">{{ Str::limit($order->description, 50) }}</td>
                                    <td class="px-4 py-2">{{ $order->object->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->date ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->time ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->department->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->category->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->progress->status ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->priority->priority ?? '-' }}</td>
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

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Order -->
    <div id="modal-tambah-order"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-2xl p-6 relative">
            <h2 class="text-lg font-semibold mb-4">Tambah Order</h2>

            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium">Judul</label>
                        <input type="text" name="title" class="w-full border rounded px-2 py-1" required>
                    </div>

                    <div>
                        <label for="object_id" class="block text-sm font-medium">Objek</label>
                        <select name="object_id" class="w-full border rounded px-2 py-1">
                            @foreach ($objects as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full border rounded px-2 py-1" required></textarea>
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium">Foto</label>
                        <input type="file" name="photo" accept="image/*" class="w-full">
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="date" class="w-full border rounded px-2 py-1" required>
                    </div>

                    <div>
                        <label for="time" class="block text-sm font-medium">Waktu</label>
                        <input type="time" name="time" class="w-full border rounded px-2 py-1" required>
                    </div>

                    <div>
                        <label for="department_id" class="block text-sm font-medium">Departemen</label>
                        <select name="department_id" class="w-full border rounded px-2 py-1">
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium">Kategori</label>
                        <select name="category_id" class="w-full border rounded px-2 py-1">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="progress_id" class="block text-sm font-medium">Progress</label>
                        <select name="progress_id" class="w-full border rounded px-2 py-1">
                            @foreach ($progresses as $prog)
                                <option value="{{ $prog->id }}">{{ $prog->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="priority_id" class="block text-sm font-medium">Prioritas</label>
                        <select name="priority_id" class="w-full border rounded px-2 py-1">
                            @foreach ($priorities as $prio)
                                <option value="{{ $prio->id }}">{{ $prio->priority }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button"
                        onclick="document.getElementById('modal-tambah-order').classList.add('hidden')"
                        class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Objek') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div x-data="itemForm()" class="mb-4">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Data Objek</h3>
                        <button @click="openCreate"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus"></i> Tambah Objek
                        </button>
                    </div>

                    <!-- Modal Tambah/Edit -->
                    <div x-show="modalOpen" x-cloak>
                        <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75">
                        </div>
                        <div class="fixed inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4">
                                <div x-show="modalOpen" x-transition @click.outside="modalOpen = false"
                                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                                    <form :action="isEditMode ? '/item/' + formData.id : '{{ route('item.store') }}'"
                                        method="POST">
                                        @csrf
                                        <template x-if="isEditMode">
                                            <input type="hidden" name="_method" value="PUT">
                                        </template>
                                        <h2 class="text-lg font-semibold mb-4"
                                            x-text="isEditMode ? 'Edit Objek' : 'Tambah Objek'"></h2>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Nama Objek</label>
                                            <input type="text" name="name" x-model="formData.name" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Departemen</label>
                                            <select name="department_id" x-model="formData.department_id" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" @click="modalOpen = false"
                                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                                                <span x-text="isEditMode ? 'Update' : 'Simpan'"></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div x-show="deleteModal" x-cloak>
                        <div x-show="deleteModal" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75">
                        </div>
                        <div class="fixed inset-0 z-40 overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div x-show="deleteModal" x-transition
                                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6"
                                    @click.outside="deleteModal = false">
                                    <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h2>
                                    <p class="mt-2 text-gray-600">Yakin ingin menghapus objek ini?</p>
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button @click="deleteModal = false"
                                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                                            Batal
                                        </button>
                                        <form :action="'/item/' + deleteId" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wrapper responsif -->
                    <div class="w-full mt-6">
                        <!-- Tabel (desktop ≥ 1024px) -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table
                                class="w-full table-auto border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-gray-200 text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left">No</th>
                                        <th class="px-4 py-2 text-left">Nama</th>
                                        <th class="px-4 py-2 text-left">Departemen</th>
                                        <th class="px-4 py-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                                    @forelse ($items as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-4 py-2">{{ $items->firstItem() + $index }}</td>
                                            <td class="px-4 py-2">{{ $item->name }}</td>
                                            <td class="px-4 py-2">{{ $item->department->name ?? '-' }}</td>
                                            <td class="px-4 py-2 space-x-2">
                                                <button
                                                    @click="openEdit({ id: {{ $item->id }}, name: '{{ $item->name }}', department_id: {{ $item->department_id }} })"
                                                    class="inline-flex items-center px-2 py-1 text-sm text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900 hover:bg-yellow-200 dark:hover:bg-yellow-800 rounded">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </button>
                                                <button @click="deleteModal = true; deleteId = {{ $item->id }}"
                                                    class="inline-flex items-center px-2 py-1 text-sm text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 rounded">
                                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                                Tidak ada data tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Card Grid (khusus mobile & tablet < 1024px) -->
                        <div class="block lg:hidden mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse ($items as $index => $item)
                                <div
                                    class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 text-gray-800 dark:text-gray-200">
                                    <p><strong>No:</strong> {{ $items->firstItem() + $index }}</p>
                                    <p><strong>Nama:</strong> {{ $item->name }}</p>
                                    <p><strong>Departemen:</strong> {{ $item->department->name ?? '-' }}</p>
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        <button
                                            @click="openEdit({ id: {{ $item->id }}, name: '{{ $item->name }}', department_id: {{ $item->department_id }} })"
                                            class="inline-flex items-center px-2 py-1 text-sm text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900 hover:bg-yellow-200 dark:hover:bg-yellow-800 rounded">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </button>
                                        <button @click="deleteModal = true; deleteId = {{ $item->id }}"
                                            class="inline-flex items-center px-2 py-1 text-sm text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 rounded">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data tersedia.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function itemForm() {
            return {
                modalOpen: false,
                isEditMode: false,
                deleteModal: false,
                deleteId: null,
                formData: {
                    id: null,
                    name: '',
                    department_id: ''
                },
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.modalOpen = true;
                },
                openEdit(item) {
                    this.isEditMode = true;
                    this.formData = {
                        ...item
                    };
                    this.modalOpen = true;
                },
                resetForm() {
                    this.formData = {
                        id: null,
                        name: '',
                        department_id: ''
                    };
                },
            }
        }
    </script>
</x-app-layout>

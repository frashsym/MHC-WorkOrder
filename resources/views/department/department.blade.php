<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Departemen') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div x-data="departmentForm()" class="mb-4">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Departemen</h3>
                        <button @click="openCreate"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus"></i> Tambah Departemen
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
                                    <form
                                        :action="isEditMode ? '/department/' + formData.id : '{{ route('department.store') }}'"
                                        method="POST">
                                        @csrf
                                        <template x-if="isEditMode">
                                            <input type="hidden" name="_method" value="PUT">
                                        </template>
                                        <h2 class="text-lg font-semibold mb-4"
                                            x-text="isEditMode ? 'Edit Departemen' : 'Tambah Departemen'"></h2>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Nama
                                                Departemen</label>
                                            <input type="text" name="name" x-model="formData.name" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
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
                                    <p class="mt-2 text-gray-600">Yakin ingin menghapus departemen ini?</p>
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button @click="deleteModal = false"
                                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                                            Batal
                                        </button>
                                        <form :action="'/department/' + deleteId" method="POST">
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

                    <!-- Tabel -->
                    <div class="w-full overflow-x-auto mt-6">
                        <table
                            class="min-w-[500px] md:min-w-full border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm">
                                <tr>
                                    <th class="px-4 py-2 text-left whitespace-nowrap">No</th>
                                    <th class="px-4 py-2 text-left whitespace-nowrap">Nama Departemen</th>
                                    <th class="px-4 py-2 text-left whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white text-sm">
                                @foreach ($departments as $index => $dept)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $departments->firstItem() + $index }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $dept->name }}</td>
                                        <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                                            <button @click="openEdit({ id: {{ $dept->id }}, name: '{{ $dept->name }}' })"
                                                class="text-yellow-600 bg-yellow-100 hover:bg-yellow-200 px-2 py-1 rounded">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </button>
                                            <button @click="deleteModal = true; deleteId = {{ $dept->id }}"
                                                class="text-red-600 bg-red-100 hover:bg-red-200 px-2 py-1 rounded">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function departmentForm() {
            return {
                modalOpen: false,
                isEditMode: false,
                deleteModal: false,
                deleteId: null,
                formData: {
                    id: null,
                    name: ''
                },
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.modalOpen = true;
                },
                openEdit(department) {
                    this.isEditMode = true;
                    this.formData = { ...department };
                    this.modalOpen = true;
                },
                resetForm() {
                    this.formData = { id: null, name: '' };
                },
            }
        }
    </script>
</x-app-layout>

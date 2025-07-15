<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Order') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Bungkus tombol + modal dalam 1 x-data -->
                <div x-data="orderForm()" x-init="init()" class="mb-4">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Order</h3>
                        {{-- Tombol Create --}}
                        <button @click="openCreate"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus"></i> Tambah Order
                        </button>
                    </div>
                    <br>

                    <!-- Modal Dinamis -->
                    <div x-show="modalOpen" x-cloak>
                        <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75">
                        </div>

                        <div class="fixed inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                <div x-show="modalOpen" x-transition @click.outside="modalOpen = false"
                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                                    <form :action="isEditMode ? '/order/' + formData.id : '{{ route('order.store') }}'"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <template x-if="isEditMode">
                                            <input type="hidden" name="_method" value="PUT">
                                        </template>
                                        <div class="bg-white px-6 py-5">
                                            <h3 class="text-lg font-semibold text-gray-900"
                                                x-text="isEditMode ? 'Edit Order' : 'Tambah Order'"></h3>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <!-- Departemen -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Departemen</label>
                                                    <select name="department_id" x-model="formData.department_id"
                                                        @change="fetchDependent(formData.department_id)"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($departments as $dept)
                                                            <option value="{{ $dept->id }}">{{ $dept->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Judul -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                                                    <input type="text" name="title" x-model="formData.title"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required>
                                                </div>

                                                <!-- Objek -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Objek</label>
                                                    <select name="item_id" x-model="formData.item_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        <template x-for="item in items" :key="item.id">
                                                            <option :value="item.id" x-text="item.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- Deskripsi -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                    <textarea name="description" x-model="formData.description" rows="3"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required></textarea>
                                                </div>

                                                <!-- Kategori -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Kategori</label>
                                                    <select name="category_id" x-model="formData.category_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        <template x-for="cat in categories" :key="cat.id">
                                                            <option :value="cat.id" x-text="cat.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- PIC -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">PIC</label>
                                                    <select name="pic_id" x-model="formData.pic_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required>
                                                        <template x-for="pic in pics" :key="pic.id">
                                                            <option :value="pic.id" x-text="pic.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- Reporter -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Reporter</label>
                                                    <select name="reporter" x-model="formData.reporter"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Progress -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Progress</label>
                                                    <select name="progress_id" x-model="formData.progress_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        @foreach ($progresses as $prog)
                                                            <option value="{{ $prog->id }}">{{ $prog->status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Prioritas -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Prioritas</label>
                                                    <select name="priority_id" x-model="formData.priority_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        @foreach ($priorities as $prio)
                                                            <option value="{{ $prio->id }}">{{ $prio->priority }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-6 py-3 sm:flex sm:flex-row-reverse">
                                            <button type="submit"
                                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto"
                                                x-text="isEditMode ? 'Update' : 'Simpan'">
                                            </button>
                                            <button type="button" @click="modalOpen = false"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                Batal
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
                                    <p class="mt-2 text-gray-600">Apakah kamu yakin ingin menghapus order ini?</p>

                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button @click="deleteModal = false"
                                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                                            Batal
                                        </button>

                                        <form :action="'/order/' + deleteId" method="POST">
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

                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full border border-gray-300 dark:border-gray-700 divide-y divide-gray-300 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Judul</th>
                                    <th class="px-4 py-2 text-left">Tanggal</th>
                                    <th class="px-4 py-2 text-left">Departemen</th>
                                    <th class="px-4 py-2 text-left">Solver</th>
                                    <th class="px-4 py-2 text-left">Kategori</th>
                                    <th class="px-4 py-2 text-left">Progress</th>
                                    <th class="px-4 py-2 text-left">Prioritas</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300 dark:divide-gray-700 text-gray-800 dark:text-white">
                                @forelse ($orders as $key => $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-4 py-2">{{ $orders->firstItem() + $key }}</td>
                                        <td class="px-4 py-2">{{ $order->title }}</td>
                                        <td class="px-4 py-2">{{ $order->date ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->department->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->picUser->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->category->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->progress->status ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->priority->priority ?? '-' }}</td>
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
                                            <button type="button"
                                                @click="deleteModal = true; deleteId = {{ $order->id }}"
                                                class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-100 hover:bg-red-200 rounded">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10"
                                            class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada order tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function orderForm() {
            return {
                modalOpen: false,
                isEditMode: false,
                deleteModal: false,
                deleteId: null,
                formData: {
                    id: null,
                    department_id: '',
                    title: '',
                    item_id: '',
                    description: '',
                    category_id: '',
                    pic: '',
                    reporter: '',
                    progress_id: '',
                    priority_id: ''
                },
                items: [],
                categories: [],
                pics: [],

                init() {},

                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.modalOpen = true;
                },

                openEdit(order) {
                    this.isEditMode = true;
                    this.formData = {
                        ...order
                    };
                    this.fetchDependent(order.department_id);
                    this.modalOpen = true;
                },

                resetForm() {
                    this.formData = {
                        id: null,
                        department_id: '',
                        title: '',
                        item_id: '',
                        description: '',
                        category_id: '',
                        pic: '',
                        reporter: '',
                        progress_id: '',
                        priority_id: ''
                    };
                    this.items = [];
                    this.categories = [];
                    this.pics = [];
                },

                fetchDependent(departmentId) {
                    if (!departmentId) return;
                    axios.get(`/api/dependent-data/${departmentId}`)
                        .then(res => {
                            this.items = res.data.items;
                            this.categories = res.data.categories;
                            this.pics = res.data.pics;
                        }).catch(err => console.error(err));
                }
            }
        }
    </script>

</x-app-layout>

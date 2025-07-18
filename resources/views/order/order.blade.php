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
                    <div class="flex justify-between items-start flex-wrap md:flex-nowrap gap-4 mb-4">
                        <!-- Kiri: Judul -->
                        <div class="flex-shrink-0">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mt-2">Daftar Order</h3>
                        </div>

                        <!-- Tengah: Filter -->
                        <div x-data="orderFilter()" class="flex flex-wrap items-end gap-4">
                            <!-- Filter Departemen -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Departemen</label>
                                <select x-model="filters.department_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    <option value="">Semua</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Objek -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Objek</label>
                                <select x-model="filters.item_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    <option value="">Semua</option>
                                    <template x-for="item in filteredItems" :key="item.id">
                                        <option :value="item.id" x-text="item.name"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Filter Waktu -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu</label>
                                <select x-model="filters.date_range" @change="handleDateRangeChange"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    <option value="">Semua</option>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">1 Minggu</option>
                                    <option value="month">1 Bulan</option>
                                    <option value="year">1 Tahun</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>

                            <!-- Tanggal Custom -->
                            <template x-if="filters.date_range === 'custom'">
                                <div class="flex gap-2">
                                    <div>
                                        <label class="block text-sm text-gray-700 dark:text-gray-300">Dari</label>
                                        <input type="date" x-model="filters.start_date"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700 dark:text-gray-300">Sampai</label>
                                        <input type="date" x-model="filters.end_date"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    </div>
                                </div>
                            </template>

                            <!-- Tombol Cari -->
                            <div>
                                <button @click="fetchOrders"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                                    Cari
                                </button>
                            </div>
                        </div>

                        <!-- Kanan: Tombol Tambah -->
                        <div class="flex-shrink-0 mt-2">
                            <button @click="openCreate"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                                <i class="fa-solid fa-plus"></i> Tambah Order
                            </button>
                        </div>
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
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required></textarea>
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
                                                    <select name="pic" x-model="formData.pic"
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
                                                <div x-show="isEditMode">
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

                                                <!-- Estimasi Pengerjaan (Tampil hanya jika progress_id == 2) -->
                                                <div x-show="formData.progress_id == 2"
                                                    class="col-span-1 sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Tanggal
                                                            Mulai Pengerjaan</label>
                                                        <input type="date" name="start_date"
                                                            x-model="formData.start_date"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Tanggal
                                                            Estimasi Selesai</label>
                                                        <input type="date" name="due_date" x-model="formData.due_date"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                    </div>
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

                    {{-- Table --}}
                    <div id="order-table" class="overflow-x-auto">
                        @include('order._table', ['orders' => $orders])
                    </div>

                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengelola filter order
        function orderFilter() {
            return {
                filters: {
                    department_id: '',
                    item_id: '',
                    date_range: '',
                    start_date: '',
                    end_date: '',
                },
                allItems: @json($items), // Kirim semua item dari controller
                get filteredItems() {
                    if (!this.filters.department_id) {
                        return this.allItems;
                    }
                    return this.allItems.filter(item => item.department_id == this.filters.department_id);
                },
                handleDateRangeChange() {
                    if (this.filters.date_range !== 'custom') {
                        this.filters.start_date = '';
                        this.filters.end_date = '';
                    }
                },
                fetchOrders() {
                    let params = new URLSearchParams(this.filters).toString();
                    fetch(`/order/filter?${params}`)
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('order-table').innerHTML = html;
                        });
                }
            }
        }

        // Fungsi untuk mengelola form order
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

                init() { },

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

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
                <div x-data="{ open: false, editModal: false, deleteModal: false, editData: {}, deleteId: null }" class="mb-4">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Order</h3>
                        <button @click="open = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus"></i> Tambah Order
                        </button>
                    </div>
                    <br>
                    <!-- Modal -->
                    <div x-data="orderForm()" x-init="init()" x-show="open" x-cloak class="relative z-10"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <!-- Background backdrop -->
                        <div x-show="open" x-transition.opacity
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                        <div class="fixed inset-0 z-10 overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                <!-- Modal content -->
                                <div x-show="open" x-transition @click.outside="open = false"
                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                                    <form action="{{ route('order.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="bg-white px-6 py-5">
                                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                                Tambah Order</h3>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                                <!-- Departemen -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Departemen</label>
                                                    <select name="department_id" x-model="selectedDepartment"
                                                        @change="fetchDependent()"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
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
                                                    <input type="text" name="title"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
                                                        required>
                                                </div>

                                                <!-- Objek -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Objek</label>
                                                    <select name="item_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                                                        <template x-for="item in items" :key="item.id">
                                                            <option :value="item.id" x-text="item.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- Deskripsi -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                    <textarea name="description" rows="3"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" required></textarea>
                                                </div>

                                                <!-- Kategori -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Kategori</label>
                                                    <select name="category_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                                                        <template x-for="cat in categories" :key="cat.id">
                                                            <option :value="cat.id" x-text="cat.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- PIC -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">PIC</label>
                                                    <select name="pic_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
                                                        required>
                                                        <template x-for="pic in pics" :key="pic.id">
                                                            cla <option :value="pic.id" x-text="pic.name">
                                                            </option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- Reporter -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Reporter</label>
                                                    <select name="reporter"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
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
                                                    <select name="progress_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
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
                                                    <select name="priority_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
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
                                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                                                Simpan
                                            </button>
                                            <button type="button" @click="open = false"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Order -->
                    {{-- catet besok beresin ini kalo ini belom selesai, harus membaca data lama tetapi kalo diganti nanti yang lainya mengikuti department --}}
                    <div x-show="editModal" x-cloak x-transition class="relative z-20" aria-modal="true" role="dialog">
                        <!-- Background -->
                        <div x-show="editModal" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75">
                        </div>

                        <div class="fixed inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                <div x-show="editModal" x-transition @click.outside="editModal = false"
                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                                    <form :action="'/order/' + editData.id" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="bg-white px-6 py-5">
                                            <h3 class="text-lg font-semibold text-gray-900">Edit Order</h3>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                                <!-- Departemen -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Departemen</label>
                                                    <select name="department_id" x-model="editData.department_id"
                                                        @change="fetchDependentForEdit(editData.department_id)"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        @foreach ($departments as $dept)
                                                            <option value="{{ $dept->id }}">{{ $dept->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Judul -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Judul</label>
                                                    <input type="text" name="title" x-model="editData.title"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required>
                                                </div>

                                                <!-- Objek -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Objek</label>
                                                    <select name="item_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        <template x-for="item in items" :key="item.id">
                                                            <option :value="item.id"
                                                                :selected="item.id === editData.item_id"
                                                                x-text="item.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- Deskripsi -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                    <textarea name="description" rows="3" x-model="editData.description"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required></textarea>
                                                </div>

                                                <!-- Kategori -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Kategori</label>
                                                    <select name="category_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        <template x-for="cat in categories" :key="cat.id">
                                                            <option :value="cat.id"
                                                                :selected="cat.id === editData.category_id"
                                                                x-text="cat.name"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- PIC -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">PIC</label>
                                                    <select name="pic_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required>
                                                        <template x-for="pic in pics" :key="pic.id">
                                                            <option :value="pic.id"
                                                                :selected="pic.id === editData.pic_id"
                                                                x-text="pic.name"></option>
                                                        </template>
                                                    </select>

                                                </div>

                                                <!-- Reporter -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Reporter</label>
                                                    <select name="reporter"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                                        required>
                                                        @foreach ($users as $user)
                                                            <option
                                                                :selected="editData.reporter === {{ $user->id }}"
                                                                value="{{ $user->id }}">
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Progress -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Progress</label>
                                                    <select name="progress_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        @foreach ($progresses as $prog)
                                                            <option
                                                                :selected="editData.progress_id === {{ $prog->id }}"
                                                                value="{{ $prog->id }}">
                                                                {{ $prog->status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Prioritas -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Prioritas</label>
                                                    <select name="priority_id"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                                                        @foreach ($priorities as $prio)
                                                            <option
                                                                :selected="editData.priority_id === {{ $prio->id }}"
                                                                value="{{ $prio->id }}">
                                                                {{ $prio->priority }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="bg-gray-50 px-6 py-3 sm:flex sm:flex-row-reverse">
                                            <button type="submit"
                                                class="inline-flex w-full justify-center rounded-md bg-yellow-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 sm:ml-3 sm:w-auto">
                                                Update
                                            </button>
                                            <button type="button" @click="editModal = false"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
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
                                        <td class="px-4 py-2">{{ $order->pic->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->category->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->progress->status ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $order->priority->priority ?? '-' }}</td>
                                        <td class="px-4 py-2 space-x-2">
                                            <!-- Tombol Info -->
                                            <a href="{{ route('order.show', $order->id) }}"
                                                class="inline-flex items-center px-2 py-1 text-sm text-blue-600 bg-blue-100 hover:bg-blue-200 rounded">
                                                <i class="fas fa-info-circle mr-1"></i> Info
                                            </a>

                                            <!-- Tombol Edit -->
                                            <button
                                                @click="editModal = true; editData = {{ $order }}; fetchDependentForEdit({{ $order->department_id }});"
                                                class="inline-flex items-center px-2 py-1 text-sm text-yellow-600 bg-yellow-100 hover:bg-yellow-200 rounded">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </button>

                                            <!-- Tombol Delete -->
                                            <button type="button"
                                                @click="openDelete = true; deleteId = {{ $order->id }}"
                                                class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-100 hover:bg-red-200 rounded">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
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
                selectedDepartment: '',
                items: [],
                categories: [],
                pics: [],

                init() {
                    this.selectedDepartment = '';
                },

                fetchDependent() {
                    if (!this.selectedDepartment) return;

                    axios.get(`/api/dependent-data/${this.selectedDepartment}`)
                        .then(res => {
                            this.items = res.data.items;
                            this.categories = res.data.categories;
                            this.pics = res.data.pics;
                        }).catch(err => {
                            console.error(err);
                        });
                },

                fetchDependentForEdit(departmentId) {
                    if (!departmentId) return;

                    axios.get(`/api/dependent-data/${departmentId}`)
                        .then(res => {
                            this.items = res.data.items;
                            this.categories = res.data.categories;
                            this.pics = res.data.pics;
                        }).catch(err => {
                            console.error(err);
                        });
                }
            }
        }
    </script>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Order
        </h2>
    </x-slot>

    <div class="py-8" x-data="orderForm()" x-init="init()">
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
                                        <label class="block text-sm font-medium text-gray-700">Departemen</label>
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
                                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea name="description" x-model="formData.description" rows="3"
                                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required></textarea>
                                    </div>

                                    <!-- Kategori -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
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
                                        <label class="block text-sm font-medium text-gray-700">Reporter</label>
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
                                        <label class="block text-sm font-medium text-gray-700">Progress</label>
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
                                            <input type="date" name="start_date" x-model="formData.start_date"
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
                                        <label class="block text-sm font-medium text-gray-700">Prioritas</label>
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
                    <div x-show="deleteModal" x-transition class="bg-white rounded-lg shadow-xl w-full max-w-md p-6"
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

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6" id="print-area">
                <div class="flex justify-between print:hidden mb-4">
                    {{-- Tombol Kiri: Edit & Delete --}}
                    <div class="flex gap-2">
                        @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                            <button @click="openEdit({{ $order }})"
                                class="inline-flex items-center px-2 py-1 text-sm text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900 hover:bg-yellow-200 dark:hover:bg-yellow-800 rounded">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                        @endif
                        @if (Auth::user()->role_id === 1)
                            <button type="button" @click="deleteModal = true; deleteId = {{ $order->id }}"
                                class="inline-flex items-center px-2 py-1 text-sm text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 rounded">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        @endif
                    </div>

                    {{-- Tombol Kanan: Print --}}
                    <div>
                        <button onclick="printOrder()"
                            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded text-sm">
                            <i class="fa-solid fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    {{ $order->title }}
                </h3>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                    <strong>No Order:</strong> {{ $order->letter_number }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800 dark:text-gray-200 print-grid-2">
                    <div><strong>Deskripsi:</strong> {{ $order->description }}</div>
                    <div><strong>Objek:</strong> {{ $order->item->name ?? '-' }}</div>
                    <div><strong>Departemen:</strong> {{ $order->department->name ?? '-' }}</div>
                    <div><strong>Kategori:</strong> {{ $order->category->name ?? '-' }}</div>
                    <div><strong>Progress:</strong> {{ $order->progress->status ?? '-' }}</div>
                    <div><strong>Prioritas:</strong> {{ $order->priority->priority ?? '-' }}</div>
                    <div><strong>Solver:</strong> {{ $order->picUser->name ?? '-' }}</div>
                    <div><strong>Reporter:</strong> {{ $order->reporterUser->name ?? '-' }}</div>
                    <div><strong>Tanggal Dibuat:</strong> {{ $order->create_date }}</div>
                    <div><strong>Waktu Dibuat:</strong> {{ $order->create_time }}</div>

                    @if ($order->started_at)
                        <div><strong>Waktu Mulai:</strong>
                            {{ \Carbon\Carbon::parse($order->started_at)->format('Y-m-d H:i:s') }}</div>
                    @endif

                    {{-- Durasi Berdasarkan Progress --}}
                    @if ($order->progress_id == 5)
                        {{-- Finish --}}
                        <div><strong>Durasi Selesai:</strong> {{ gmdate('H:i:s', $order->total_duration) }}</div>
                    @elseif ($order->progress_id == 3)
                        {{-- On Progress --}}
                        @php
                            $resumeTime = \Carbon\Carbon::parse($order->resume_at);
                            $now = now();
                            $runningSeconds = $order->total_duration + $resumeTime->diffInSeconds($now);
                        @endphp
                        <div>
                            <strong>Waktu Berjalan:</strong>
                            <span id="running-duration" data-start="{{ $resumeTime->timestamp }}"
                                data-total="{{ $order->total_duration }}">
                                {{ gmdate('H:i:s', $runningSeconds) }}
                            </span>
                        </div>
                    @elseif ($order->progress_id == 4 && $order->paused_at && $order->started_at)
                        @php
                            $durasiSaatHold = $order->total_duration; // dalam detik
                        @endphp

                        <div>
                            <strong>Waktu Pause:</strong>
                            {{ \Carbon\Carbon::parse($order->paused_at)->format('Y-m-d H:i:s') }}
                        </div>
                        <div>
                            <strong>Durasi Saat Di-Hold:</strong> {{ gmdate('H:i:s', $durasiSaatHold) }}
                        </div>
                    @endif
                    @if ($order->progress_id == 2)
                        <div>
                            <strong>Dijadwalkan Pada:</strong>
                            {{ \Carbon\Carbon::parse($order->start_date)->format('Y-m-d') }}
                        </div>
                        <div>
                            <strong>Estimasi Selesai:</strong>
                            {{ \Carbon\Carbon::parse($order->due_date)->format('Y-m-d') }}
                        </div>
                    @endif
                </div>

                <div class="mt-6 print:hidden">
                    <a href="{{ route('order.index') }}"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            @page {
                size: landscape;
                margin: 20mm;
            }

            body {
                background: white !important;
                color: black !important;
                font-family: Arial, sans-serif;
            }

            .dark,
            .dark * {
                background-color: white !important;
                color: black !important;
            }

            .print\:hidden {
                display: none !important;
            }

            /* Force grid to stay 2 columns in print */
            .print-grid-2 {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 1rem;
            }
        }
    </style>

    {{-- Real-time Timer --}}
    @if ($order->progress_id == 3 && $order->resume_at)
        <script>
            const resumeTimestamp = parseInt(document.getElementById('running-duration').dataset.start);
            const totalDurationBefore = parseInt(document.getElementById('running-duration').dataset.total);
            const durationEl = document.getElementById('running-duration');

            function updateDuration() {
                const now = Math.floor(Date.now() / 1000);
                const elapsed = now - resumeTimestamp + totalDurationBefore;

                const hours = String(Math.floor(elapsed / 3600)).padStart(2, '0');
                const minutes = String(Math.floor((elapsed % 3600) / 60)).padStart(2, '0');
                const seconds = String(elapsed % 60).padStart(2, '0');

                durationEl.textContent = `${hours}:${minutes}:${seconds}`;
            }

            setInterval(updateDuration, 1000);
        </script>
    @endif

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
                items: @json($items),
                categories: @json($categories),
                pics: @json($pics),

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

    {{-- Modal Delete Confirmation --}}
    <script>
        function printOrder() {
            window.print(); // langsung print halaman ini
        }
    </script>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Order
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6" id="print-area">
                <div class="flex justify-end print:hidden">
                    <button onclick="printOrder()"
                        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded text-sm">
                        <i class="fa-solid fa-print"></i> Print
                    </button>
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

                    @if ($order->paused_at)
                        <div><strong>Waktu Pause:</strong>
                            {{ \Carbon\Carbon::parse($order->paused_at)->format('Y-m-d H:i:s') }}</div>
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
        function printOrder() {
            window.print(); // langsung print halaman ini
        }
    </script>

</x-app-layout>

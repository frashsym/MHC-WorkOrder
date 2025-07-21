<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('dashboard') }}"
                    class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md mb-4 flex flex-wrap items-center gap-2">
                    <label class="text-gray-700 dark:text-gray-200">Pilih Bulan:</label>
                    <select name="month" class="rounded p-1 text-sm">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>

                    <label class="text-gray-700 dark:text-gray-200">Tahun:</label>
                    <select name="year" class="rounded p-1 text-sm">
                        @for ($y = now()->year - 2; $y <= now()->year + 1; $y++)
                            <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>

                    <button type="submit"
                        class="ml-2 px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                        Tampilkan
                    </button>
                </form>

                <canvas id="orderChart" height="120"></canvas>

                <script>
                    const ctx = document.getElementById('orderChart').getContext('2d');
                    const rawLabels = @json($rawLabels); // Untuk tooltip
                    const labels = @json($labels); // Untuk sumbu X

                    const datasets = @json($chartData).map((set, index) => {
                        const colors = ['#007bff', '#28a745', '#ffc107'];
                        return {
                            label: set.label,
                            data: set.data,
                            borderColor: colors[index % colors.length],
                            backgroundColor: colors[index % colors.length] + '33',
                            fill: true,
                            tension: 0.3
                        };
                    });

                    const orderChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Grafik Order per Hari Bulan Ini per Departemen'
                                },
                                tooltip: {
                                    callbacks: {
                                        title: (tooltipItems) => {
                                            const index = tooltipItems[0].dataIndex;
                                            return rawLabels[index]; // Tampilkan "22 Juli 2025"
                                        },
                                        label: (tooltipItem) => {
                                            return `${tooltipItem.dataset.label}: ${tooltipItem.formattedValue} order`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1,
                                    suggestedMax: 10
                                }
                            }
                        }
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>

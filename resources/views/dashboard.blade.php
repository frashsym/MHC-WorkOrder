<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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

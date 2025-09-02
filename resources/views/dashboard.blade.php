<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w+-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('dashboard') }}"
                    class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md mb-4 flex flex-col sm:flex-row sm:items-end sm:gap-4">
                    <div class="flex flex-col sm:flex-1">
                        <label class="text-gray-700 dark:text-gray-200 mb-1">Pilih Bulan:</label>
                        <select name="month" class="rounded p-2 text-sm w-full">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col sm:flex-1">
                        <label class="text-gray-700 dark:text-gray-200 mb-1">Tahun:</label>
                        <select name="year" class="rounded p-2 text-sm w-full">
                            @for ($y = now()->year - 2; $y <= now()->year + 1; $y++)
                                <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <br>
                    <div class="flex sm:flex-none mt-2 sm:mt-0">
                        <button type="submit"
                            class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                            Tampilkan
                        </button>
                    </div>
                </form>
                <div class="overflow-x-auto">
                    <div class="min-w-[500px] sm:min-w-full">
                        <canvas id="orderChart" class="w-full" height="220"></canvas>
                    </div>
                </div>
                <div id="orderTableContainer" class="mt-6"></div>

                <script>
                    const selectedMonth = {{ $selectedMonth }};
                    const selectedYear = {{ $selectedYear }};
                    const ctx = document.getElementById('orderChart').getContext('2d');
                    const rawLabels = @json($rawLabels);
                    const labels = @json($labels);
                    const datasets = @json($chartData).map((set, index) => {
                        const colors = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1'];
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
                                    display: {{ Auth::user()->role_id === 4 ? 'false' : 'true' }},
                                    text: 'Grafik Order per Hari Bulan Ini per Departemen'
                                },
                                tooltip: {
                                    callbacks: {
                                        title: (tooltipItems) => rawLabels[tooltipItems[0].dataIndex],
                                        label: (tooltipItem) =>
                                            `${tooltipItem.dataset.label}: ${tooltipItem.formattedValue} order`
                                    }
                                }
                            },
                            onClick: async (event, elements) => {
                                if (!elements.length) return;

                                const point = elements[0];
                                const datasetIndex = point.datasetIndex;
                                const dataIndex = point.index;

                                const department = datasets[datasetIndex].label;
                                const day = labels[dataIndex].toString().padStart(2, '0');
                                const month = selectedMonth.toString().padStart(2, '0');
                                const date = `${selectedYear}-${month}-${day}`;

                                try {
                                    const res = await fetch("{{ route('dashboard.ordersByDateAndDepartment') }}?date=" +
                                        encodeURIComponent(date) + "&department=" + encodeURIComponent(department), {
                                        credentials: 'same-origin'
                                    });
                                    const html = await res.text();
                                    document.getElementById('orderTableContainer').innerHTML = html;
                                } catch (err) {
                                    console.error('Gagal mengambil data:', err);
                                }
                            }
                        }
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>

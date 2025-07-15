<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Order
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    {{ $order->title }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800 dark:text-gray-200">
                    <div><strong>Deskripsi:</strong> {{ $order->description }}</div>
                    <div><strong>Objek:</strong> {{ $order->item->name ?? '-' }}</div>
                    <div><strong>Departemen:</strong> {{ $order->department->name ?? '-' }}</div>
                    <div><strong>Kategori:</strong> {{ $order->category->name ?? '-' }}</div>
                    <div><strong>Progress:</strong> {{ $order->progress->status ?? '-' }}</div>
                    <div><strong>Prioritas:</strong> {{ $order->priority->priority ?? '-' }}</div>
                    <div><strong>Solver:</strong> {{ $order->picUser->name ?? '-' }}</div>
                    <div><strong>Pelapor:</strong> {{ $order->reporterUser->name ?? '-' }}</div>
                    <div><strong>Tanggal:</strong> {{ $order->date }}</div>
                    <div><strong>Waktu:</strong> {{ $order->time }}</div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('order.index') }}"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

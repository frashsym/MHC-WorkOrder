<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{-- {{ $header }} --}}
                    <!-- Animated Text Area (tampil di semua perangkat) -->
                    <div class="animated-banner text-blue-500 text-base font-semibold text-center py-2">
                        <div id="text-a" class="opacity-0 translate-x-full">A</div>
                        <div id="text-b" class="opacity-0 translate-x-full">B</div>
                    </div>
                    <br>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 tidak dimuat dengan benar.');
                return;
            }

            // Success message
            @if (session('success'))
                Swal.fire({
                    title: 'Sukses!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            // Error messages
            @if ($errors->any())
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += "{{ $error }}\n";
                @endforeach

                Swal.fire({
                    title: 'Oops!',
                    text: errorMessages,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        });
        const messages = [
            'Metland Spirit',
            'Integritas',
            'Semangat',
            'Profesional',
            'Kerja Keras',
            'Enterpreneurship',
            'Pantang Menyerah',
            'Metland Coloring Life'
        ];

        let index = 0;
        let isAActive = true;

        const textA = document.getElementById('text-a');
        const textB = document.getElementById('text-b');

        function animateText() {
            const current = isAActive ? textA : textB;
            const next = isAActive ? textB : textA;

            // Reset posisi next di luar kanan
            next.textContent = messages[index];
            next.classList.remove('translate-x-0', 'opacity-100');
            next.classList.add('translate-x-full', 'opacity-0');

            void next.offsetWidth; // trigger reflow agar animasi aktif

            // Munculkan next ke tengah
            next.classList.remove('translate-x-full', 'opacity-0');
            next.classList.add('translate-x-0', 'opacity-100');

            // Geser keluar current ke kanan
            current.classList.remove('translate-x-0', 'opacity-100');
            current.classList.add('translate-x-full', 'opacity-0');

            isAActive = !isAActive;
            index = (index + 1) % messages.length;
        }

        window.addEventListener('load', () => {
            setTimeout(() => {
                animateText();
                setInterval(animateText, 2500);
            }, 1000);
        });
    </script>

</body>

</html>
````

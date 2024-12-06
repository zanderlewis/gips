<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GIPS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-gray-900 dark:text-gray-300">
    <div class="bg-gray-50 text-gray-700 dark:bg-gray-900 dark:text-gray-300">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <x-application-logo class="h-20 w-auto lg:h-25" />
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="rounded-md px-3 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-gray-500 focus:outline-none focus-visible:ring-blue-500 dark:text-gray-300 dark:hover:text-gray-100 dark:focus-visible:ring-gray-300">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-gray-500 focus:outline-none focus-visible:ring-blue-500 dark:text-gray-300 dark:hover:text-gray-100 dark:focus-visible:ring-gray-300">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-gray-500 focus:outline-none focus-visible:ring-blue-500 dark:text-gray-300 dark:hover:text-gray-100 dark:focus-visible:ring-gray-300">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="mt-6">
                    <section class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">Welcome to GIPS</h1>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">This is the GIPS for Wagstaff Primes</p>
                        <a href="/register"
                            class="mt-6 inline-block rounded-md bg-blue-500 px-6 py-3 text-white transition hover:bg-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-800">Get
                            Started</a>
                    </section>

                    <section id="discover" class="mt-12 grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <x-card title="Discover GIPS"
                            description="Learn about the unique properties of Wagstaff primes and how you can contribute to finding the largest ones."
                            link="/learn-more" linkText="Learn More" />

                        <x-card title="Contribute to Research"
                            description="Join the community of mathematicians and researchers in the quest to find the largest Wagstaff primes."
                            link="/contribute" linkText="Contribute Now" />
                    </section>
                </main>

                <footer class="py-16 text-center text-sm text-gray-600 dark:text-gray-400">
                    Zander Lewis &copy; {{ date('Y') }}. All rights reserved.
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
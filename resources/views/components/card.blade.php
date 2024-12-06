<div
    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-lg ring-1 ring-gray-200 transition duration-300 hover:text-gray-700 hover:ring-gray-300 focus:outline-none focus-visible:ring-blue-500 dark:bg-gray-800 dark:ring-gray-700 dark:hover:text-gray-100 dark:hover:ring-gray-600 dark:focus-visible:ring-blue-500">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h2>
    <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">{{ $description }}</p>
    <a href="{{ $link }}"
        class="mt-4 inline-block rounded-md bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-800">{{ $linkText }}</a>
</div>

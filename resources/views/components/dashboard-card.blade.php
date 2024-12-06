<div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $description }}</p>
    <div class="text-gray-600 dark:text-gray-400 mt-4">
        {{ $slot }}
    </div>
    @if ($link && $linkText)
        <a href="{{ $link }}"
            class="mt-4 inline-block rounded-md bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-800">{{ $linkText }}</a>
    @endif
</div>

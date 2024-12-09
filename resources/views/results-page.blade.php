<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-dashboard-card title="Results" description="Your exponent results.">
                @if ($results->isEmpty())
                    <p class="text-gray-500">No results found.</p>
                @else
                    @foreach ($results as $result)
                        <div class="flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-4">
                                    <div>
                                        <p class="text-lg font-semibold">{{ $result->exponent }}</p>
                                    </div>
                                    <div>
                                        <p class="text-md text-gray-500">{{ $result->is_prime ? 'Prime' : 'Composite' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('results', $result) }}"
                                        class="text-blue-500 hover:text-blue-700">View</a>
                                </div>
                            </div>
                            <p id="result-{{ $result->id }}" class="text-sm text-gray-500"></p>
                        </div>
                    @endforeach
                @endif
            </x-dashboard-card>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const results = @json($results);
            results.forEach(result => {
                const date = moment(result.updated_at); // Parse the date
                const localDate = date.format('LLLL'); // Format the date as needed
                const pTag = document.getElementById(`result-${result.id}`);
                if (pTag) {
                    pTag.textContent = 'Completed: ' + localDate;
                }
            });
        });
    </script>
</div>

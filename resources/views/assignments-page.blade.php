<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assignments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-dashboard-card title="Assignments" description="Your currently assigned exponents.">
                @if ($assignments->isEmpty())
                    <p class="text-gray-500">No current assignments found.</p>
                @else
                    @foreach ($assignments as $assignment)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-semibold">{{ $assignment->exponent }}</p>
                                <p id="assignment-{{ $assignment->id }}" class="text-sm text-gray-500"></p>
                                <p id="expires-{{ $assignment->id }}" class="text-sm text-semibold text-red-500"></p>
                            </div>
                            <div>
                                <a href="{{ route('assignments', $assignment) }}"
                                    class="text-blue-500 hover:text-blue-700">View</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </x-dashboard-card>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const assignments = @json($assignments);
            assignments.forEach(assignment => {
                const date = moment(assignment.created_at);
                const expiryDate = moment(assignment.expiration_date);
                const localDate = date.format('LLLL'); // Format the date as needed
                const localExpiryDate = expiryDate.format('LLLL');
                const pTag = document.getElementById(`assignment-${assignment.id}`);
                const pExpiryTag = document.getElementById(`expires-${assignment.id}`);
                if (pTag) {
                    pTag.textContent = localDate;
                }
                if (pExpiryTag) {
                    pExpiryTag.textContent = `Expires: ${localExpiryDate}`;
                }
            });
        });
    </script>
</div>
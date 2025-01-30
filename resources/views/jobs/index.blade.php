<x-layout>
    <x-slot name="title">Workhive | Jobs</x-slot>
    <div class="bg-blue-900 p-6 flex justify-center items-center mb-4 w-full">
        <x-search />
    </div>
    <ul>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($jobs as $job)
                <x-job-card :job="$job" />
            @empty
                <p>No jobs available.</p>
            @endforelse
        </div>
    </ul>
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</x-layout>

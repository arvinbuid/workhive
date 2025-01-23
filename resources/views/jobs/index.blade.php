<x-layout>
    <x-slot name="title">Workhive | Jobs</x-slot>
    <h1 class="text-2xl mb-4">Available Jobs</h1>
    <ul>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($jobs as $job)
                <x-job-card :job="$job" />
            @empty
                <p>No jobs available.</p>
            @endforelse
        </div>
    </ul>
</x-layout>

<x-layout>
    <h1 class="text-3xl font-bold text-center mb-4 p-3 border border-gray-300">Welcome to Workhive</h1>
    <ul>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($jobs as $job)
                <x-job-card :job="$job" />
            @empty
                <p>No jobs available.</p>
            @endforelse
        </div>
    </ul>
    <a href={{ route('jobs.index') }} class="block text-center text-xl font-bold mt-6 tracking-tight"><i
            class="fa fa-arrow-alt-circle-right mr-2"></i>View All Jobs</a>
    <x-bottom-banner />
</x-layout>

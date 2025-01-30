<x-layout>
    <x-slot name="title">Workhive | Jobs</x-slot>
    <div class="bg-blue-900 p-6 flex justify-center items-center mb-4 w-full rounded">
        <x-search />
    </div>

    {{-- Back button --}}
    @if (request()->has('keywords') || request()->has('location'))
        <a href="{{ route('jobs.index') }}"
            class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
            <i class="fa fa-arrow-left mr-1"></i> Back
        </a>
    @endif

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

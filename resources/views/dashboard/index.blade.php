<x-layout>
    <h1>Dashboard</h1>
    {{ $user->name }}
    <ul>
        @forelse($user->jobs as $job)
            <li>
                {{ $job->id }} - {{ $job->title }}
            </li>
        @empty
            <p>No jobs available.</p>
        @endforelse
    </ul>
</x-layout>

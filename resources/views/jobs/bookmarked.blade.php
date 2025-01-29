<x-layout>
    <h3 class="text-3xl text-center font-bold border border-gray-300 mb-3 p-4">
        Bookmarked Jobs
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($bookmarks as $bookmark)
            <x-job-card :job="$bookmark" />
        @empty
            <p class="text-center-text-2xl">You have no bookmarked job listing.</p>
        @endforelse
    </div>
</x-layout>

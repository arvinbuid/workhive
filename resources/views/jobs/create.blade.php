<x-layout>
    <h1>Create a Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <div class="py-5">
            <input type="text" name="title" placeholder="Enter job title..." value={{ old('title') }}>
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input type="text" name="description" placeholder="Enter job description..."
                value={{ old('description') }}>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Submit</button>
    </form>
</x-layout>

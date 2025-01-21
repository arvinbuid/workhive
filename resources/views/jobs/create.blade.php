<x-layout>
    <h1>Create a Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Enter job title...">
        <input type="text" name="description" placeholder="Enter job description...">
        <button type="submit">Submit</button>
    </form>
</x-layout>

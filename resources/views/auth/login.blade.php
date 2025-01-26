<x-layout>
    <div class="bg-white rounded-lg md:max-w-xl w-full shadow-md mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl font-bold text-center mb-8">Login</h2>
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf

            <x-inputs.text id="email" name="email" type="email" placeholder="Email Address" />
            <x-inputs.text id="password" name="password" type="password" placeholder="Enter Password" />

            <button type="submit"
                class="w-full text-white mt-1 px-4 py-2 rounded bg-blue-500 hover:bg-blue-600 focus:outline-none">
                Login
            </button>

            <p class="text-gray-500 mt-3">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-900">Register</a>
            </p>
        </form>
    </div>
</x-layout>

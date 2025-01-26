@props(['class' => ''])

<form method="POST" action="{{ route('logout') }}" class="{{ $class }}">
    @csrf
    <button type="submit">
        <i class="fa fa-sign-out mr-1"></i>Logout
    </button>
</form>

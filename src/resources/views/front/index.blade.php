<form method="POST" action="{{ route('front.logout') }}">
    @csrf

    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
        {{ __('Log Out') }}
    </button>
</form>

<!-- SIDEBAR -->
<aside class="w-64 bg-black text-white">
    <div class="p-6 text-xl font-bold border-b border-gray-700">
        Assessment App
    </div>

    <nav class="p-4 space-y-2">
        <a href="#" class="block px-4 py-2 rounded bg-red-600">
            Dashboard
        </a>
        <a href="{{ route('performance.periods') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            Assessments
        </a>

        <a href="{{ route('settings.manager-assessment') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            Manager Assessment Settings
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </nav>
</aside>

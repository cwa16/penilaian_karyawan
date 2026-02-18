<!-- SIDEBAR -->
<aside id="sidebar" class="w-60 bg-black text-white transition-all duration-300">
    <div class="p-6 text-xl font-bold border-b border-gray-700">
        Assessment App
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Dashboard
        </a>
        <a href="{{ route('performance.periods') }}" class="block px-4 py-2 rounded {{ request()->routeIs('performance.*') || request()->routeIs('admin.performance.*') || request()->routeIs('summary') || request()->routeIs('summary.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Assessments
        </a>
        <a href="{{ route('kpi.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('kpi.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Penilai KPI
        </a>
        <a href="{{ route('settings.manager-assessment') }}" class="block px-4 py-2 rounded {{ request()->routeIs('settings.manager-assessment') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Manager Assessment Settings
        </a>
        <a href="{{ route('criteria.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('criteria.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Master Criteria
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
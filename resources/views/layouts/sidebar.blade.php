<!-- SIDEBAR -->
<aside id="sidebar" class="w-60 bg-black text-white transition-all duration-300">
    <div class="p-6 text-xl font-bold border-b border-gray-700">
        Assessment App
    </div>

    <nav class="p-4 space-y-2">

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded
           {{ request()->routeIs('dashboard') ? 'bg-red-600' : 'hover:bg-gray-700' }}">
            Dashboard
        </a>
        <a href="{{ route('performance.periods') }}" class="block px-4 py-2 rounded {{ request()->routeIs('performance.*') || request()->routeIs('admin.performance.*') || request()->routeIs('summary') || request()->routeIs('summary.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Assessments
        </a>

        {{-- PENILAI KPI --}}
        <a href="{{ route('kpi.index') }}"
           class="block px-4 py-2 rounded
           {{ request()->routeIs('kpi.*') ? 'bg-red-600' : 'hover:bg-gray-700' }}">
            KPI Asessment
        </a>
        <a href="{{ route('settings.manager-assessment') }}" class="block px-4 py-2 rounded {{ request()->routeIs('settings.manager-assessment') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Manager Assessment Settings
        </a>
        <a href="{{ route('criteria.index') }}" class="block px-4 py-2 rounded {{ request()->routeIs('criteria.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
            Master Criteria
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left px-4 py-2 rounded hover:bg-gray-700">
                Log Out
            </button>
        </form>

    </nav>
</aside>

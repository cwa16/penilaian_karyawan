<!-- SIDEBAR -->
<aside class="w-64 bg-black text-white">
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

        {{-- ASSESSMENTS --}}
        <a href="{{ route('performance.periods') }}"
           class="block px-4 py-2 rounded
           {{ request()->routeIs('performance.periods') || request()->is('performance/periods*') ? 'bg-red-600' : 'hover:bg-gray-700' }}">
            Assessments
        </a>

        {{-- MANAGER ASSESSMENT SETTINGS --}}
        <a href="{{ route('settings.manager-assessment') }}"
           class="block px-4 py-2 rounded
           {{ request()->routeIs('settings.manager-assessment') ? 'bg-red-600' : 'hover:bg-gray-700' }}">
            Manager Assessment Settings
        </a>

        {{-- MASTER CRITERIA --}}
        <a href="{{ route('criteria.index') }}"
           class="block px-4 py-2 rounded
           {{ request()->routeIs('criteria.*') ? 'bg-red-600' : 'hover:bg-gray-700' }}">
            Master Criteria
        </a>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-gray-700">
            @csrf
            <button type="submit"
                class="w-full text-left px-4 py-2 rounded hover:bg-gray-700">
                Log Out
            </button>
        </form>

    </nav>
</aside>

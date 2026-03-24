<!-- SIDEBAR -->
<aside id="sidebar" class="w-60 bg-black text-white transition-all duration-300">
    <div class="p-6 text-xl font-bold border-b border-gray-700">
        Assessment App
    </div>

    <nav class="p-3 space-y-1 text-sm">
        <p class="px-4 mt-4 mb-2 text-gray-400 font-semibold uppercase tracking-wider" style="font-size:7px;">Main</p>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>    
        Dashboard
        </a>
        <div class="mx-4 border-b border-gray-700 mt-4"></div>
        <div class="h-2"></div>

        <p class="px-4 mt-4 mb-2 text-gray-400 font-semibold uppercase tracking-wider" style="font-size:7px;">Performance Management</p>
        <a href="{{ route('performance.periods') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('performance.*') || request()->routeIs('admin.performance.*') || request()->routeIs('summary') || request()->routeIs('summary.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-icon lucide-file-pen"><path d="M12.659 22H18a2 2 0 0 0 2-2V8a2.4 2.4 0 0 0-.706-1.706l-3.588-3.588A2.4 2.4 0 0 0 14 2H6a2 2 0 0 0-2 2v9.34"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="M10.378 12.622a1 1 0 0 1 3 3.003L8.36 20.637a2 2 0 0 1-.854.506l-2.867.837a.5.5 0 0 1-.62-.62l.836-2.869a2 2 0 0 1 .506-.853z"/></svg>
        Assessments
        </a>
        <a href="{{ route('assessment.monitoring') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('assessment.monitoring') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-checks-icon lucide-list-checks"><path d="M13 5h8"/><path d="M13 12h8"/><path d="M13 19h8"/><path d="m3 17 2 2 4-4"/><path d="m3 7 2 2 4-4"/></svg>    
        Monitoring
        </a>
        <div class="mx-4 border-b border-gray-700 mt-4"></div>
        <div class="h-2"></div>

        <p class="px-4 mt-4 mb-2 text-gray-400 font-semibold uppercase tracking-wider" style="font-size:7px;">KPI Management</p>
        <a href="{{ route('kpi.index') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('kpi.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-column-icon lucide-chart-no-axes-column"><path d="M5 21v-6"/><path d="M12 21V3"/><path d="M19 21V9"/></svg>    
        KPI 
        </a>
        <a href="{{ route('kpi-kualitatif.periods') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('kpi-kualitatif.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-column-icon lucide-chart-no-axes-column"><path d="M5 21v-6"/><path d="M12 21V3"/><path d="M19 21V9"/></svg>    
        Qualitatif KPI
        </a>
        <div class="mx-4 border-b border-gray-700 mt-4"></div>
        <div class="h-2"></div>

        <p class="px-4 mt-4 mb-2 text-gray-400 font-semibold uppercase tracking-wider" style="font-size:7px;">Employee Data</p>
        <a href="{{ route('employee-details.index') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('employee-details.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-search-icon lucide-user-round-search"><circle cx="10" cy="8" r="5"/><path d="M2 21a8 8 0 0 1 10.434-7.62"/><circle cx="18" cy="18" r="3"/><path d="m22 22-1.9-1.9"/></svg>    
        Employee Details
        </a>
        <a href="{{ route('criteria.index') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('criteria.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check-icon lucide-book-check"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9 9.5 2 2 4-4"/></svg>    
        Master Criteria
        </a>
        <div class="mx-4 border-b border-gray-700 mt-4"></div>
        <div class="h-2"></div>

        <p class="px-4 mt-4 mb-2 text-gray-400 font-semibold uppercase tracking-wider" style="font-size:7px;">System Settings</p>
        <a href="{{ route('settings.manager-assessment') }}" class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('settings.manager-assessment') ? 'bg-red-600 text-white' : 'hover:bg-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>    
        Manager Assessment Settings
        </a>
        <div class="mx-4 border-b border-gray-700 mt-4"></div>
        <div class="h-2"></div>

        <p class="px-4 mt-4 mb-2 text-gray-400 font-semibold uppercase tracking-wider" style="font-size:7px;">Account</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>    
                Log Out
            </a>
            <div class="mx-4 border-b border-gray-700 mt-4"></div>
        </form>
    </nav>
</aside>
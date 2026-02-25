<div 
    x-data="{ open: false }"
    @open-period-create.window="open = true"
    @keydown.escape.window="open = false"
>
    <!-- BACKDROP -->
    <div 
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40"
        @click="open = false"
    ></div>

    <!-- MODAL CONTENT -->
    <div 
        x-show="open"
        x-transition
        class="fixed inset-0 flex items-center justify-center z-50 p-4"
    >
        <div class="bg-white w-full max-w-2xl rounded-xl shadow-2xl relative">

            <!-- CLOSE BUTTON -->
            <button 
                @click="open = false"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                ✕
            </button>

            <!-- PANGGIL FORM CREATE -->
            @include('admin.performance.periods.create')

        </div>
    </div>
</div>
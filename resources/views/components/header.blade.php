<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-900">
                {{ $slot }}
            </h2>
            
            @if(isset($actions))
                <div class="flex space-x-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
</header>

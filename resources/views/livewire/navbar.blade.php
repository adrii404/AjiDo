<header class="bg-white border-b border-pink-100 px-8 py-5 flex items-center justify-between">

    {{-- Logo --}}
    <div class="px-4">
        <h1 class="text-3xl font-black tracking-tight text-pink-600">
            Aji <span class="text-pink-400">Do!</span>
        </h1>
    </div>

    {{-- Right Side --}}
    <div class="flex items-center">

        <x-dropdown align="right" width="48">

            {{-- Trigger --}}
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center gap-3 px-3 py-2
                           rounded-2xl bg-pink-50 border border-pink-100
                           hover:bg-pink-100 transition-all duration-200">

                    {{-- Avatar --}}
                    <div
                        class="w-9 h-9 rounded-full
                               bg-gradient-to-br from-pink-400 to-pink-300
                               flex items-center justify-center
                               text-white text-sm font-bold shadow-sm">

                        {{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 1)) }}

                    </div>

                    {{-- Name --}}
                    <div class="text-sm font-medium text-pink-700">
                        {{ Auth::user()->name ?? 'Guest' }}
                    </div>

                    {{-- Arrow --}}
                    <svg class="fill-current h-4 w-4 text-pink-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">

                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />

                    </svg>

                </button>
            </x-slot>

            {{-- Dropdown Content --}}
            <x-slot name="content">

                <div class="p-1">

                    <x-dropdown-link :href="route('profile')"
                        class="rounded-xl text-pink-700 hover:bg-pink-50">
                        Profile
                    </x-dropdown-link>

                    <button
                        wire:click="logout"
                        class="w-full px-4 py-2 text-left text-sm
                               rounded-xl text-pink-700
                               hover:bg-pink-50 transition">

                        Logout

                    </button>

                </div>

            </x-slot>

        </x-dropdown>

    </div>

</header>
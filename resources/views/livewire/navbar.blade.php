<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirectRoute('login');
    }
};

?>

<header class="bg-pink-200 shadow px-6 py-6 flex justify-between">

    <div class="px-12 text-3xl font-bold  text-pink-800">
        Aji Do!
    </div>
    <div class="flex items-center">

        <x-dropdown align="right" width="48">

            {{-- Trigger --}}
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent
                           text-sm leading-4 font-medium rounded-md text-gray-500
                           bg-white hover:text-gray-700 focus:outline-none
                           transition ease-in-out duration-150">

                    <div>
                        {{ Auth::user()->name ?? 'Guest' }}
                    </div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                </button>
            </x-slot>

            {{-- Dropdown Content --}}
            <x-slot name="content">

                {{-- Profile --}}
                <x-dropdown-link :href="route('profile')">
                    Profile
                </x-dropdown-link>

                {{-- Logout --}}
                <button wire:click="logout" class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">

                    Logout

                </button>

            </x-slot>

        </x-dropdown>

    </div>

</header>

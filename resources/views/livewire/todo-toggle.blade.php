<div class="bg-white shadow rounded-xl p-5">
    <div x-data="{ completed: @entangle('completed') }">
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-start gap-3">
                <input type="checkbox" wire:click="toggle" x-model="completed"
                    class="w-5 h-5 mt-1 rounded-full text-pink-600 border-gray-300 focus:ring-pink-500">

                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-xl font-semibold"
                            :class="{ 'line-through text-gray-400': completed, '': !completed }">
                            {{ $todo->title }}
                        </h2>

                        @if ($todo->category === 'Professional' && $todo->subcategory)
                            <span
                                class="px-3 py-2 rounded-full text-xs font-semibold
                                {{ $todo->subcategory === 'Freelance' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $todo->subcategory }}
                            </span>
                        @endif
                    </div>

                    @if ($todo->description)
                        <p class="mt-2"
                            :class="{ 'text-gray-400 line-through': completed, 'text-gray-600': !completed }">
                            {{ $todo->description }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if ($todo->due_at)
                    <span class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($todo->due_at)->format('M d, Y • g:i A') }}
                    </span>
                @endif

                <div class="relative" x-data="{ localMenuOpen: false }">
                    <button type="button" @click.stop="localMenuOpen = !localMenuOpen"
                        class="p-2 rounded-full hover:bg-gray-100 transition">
                        &vellip;
                    </button>

                    <div x-show="localMenuOpen" @click.away="localMenuOpen = false" x-cloak
                        class="absolute right-0 mt-2 w-36 bg-white border rounded-xl shadow-lg overflow-hidden z-50">

                        <button type="button" @click="localMenuOpen = false; $wire.openEditModal();"
                            class="w-full text-left px-4 py-3 hover:bg-gray-50 text-gray-700 text-sm transition">
                            Edit
                        </button>

                        <form method="POST" action="/todos/{{ $todo->id }}"
                            onsubmit="return confirm('Delete this todo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</div>

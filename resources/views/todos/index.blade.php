<x-app-layout>
    <div class="max-w-4xl  py-10 px-6">

        <h1 class="text-3xl font-bold mb-6 text-pink-800">
            Todo Planner
        </h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div x-data="{ open: false }">

            {{-- OPEN MODAL BUTTON --}}
            <button @click="open = true" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg mb-6">
                + Create Todo
            </button>

            {{-- MODAL BACKDROP --}}
            <div x-show="open" x-transition class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

                {{-- MODAL CARD --}}
                <div @click.outside="open = false" class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-pink-800">
                            Create Todo
                        </h2>

                        <button @click="open = false" class="text-gray-500 hover:text-black text-xl">
                            ✕
                        </button>
                    </div>

                    <form action="/todos" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Title
                            </label>

                            <input type="text" name="title" class="w-full border rounded-lg px-4 py-2"
                                placeholder="Enter todo title">

                            @error('title')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Description
                            </label>

                            <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2"
                                placeholder="Todo description..."></textarea>
                        </div>
                        <label class="block text-sm font-medium mb-1">
                            Category
                        </label>

                        <select name="category" class="w-full border rounded-lg px-4 py-2">
                            <option value="Full Time">Full Time</option>
                            <option value="Freelance">Freelance</option>
                        </select>
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Due Date
                            </label>

                            <input type="date" name="due_date" class="w-full border rounded-lg px-4 py-2">
                        </div>

                        <div class="flex justify-end gap-3 pt-2">

                            <button type="button" @click="open = false" class="px-4 py-2 rounded-lg border">
                                Cancel
                            </button>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                                Create Todo
                            </button>

                        </div>
                    </form>

                </div>
            </div>


        </div>
    </div>

    <div class="space-y-4">

        @forelse($todos as $todo)
            <livewire:todo-toggle :todo="$todo" :key="$todo->id" />
        @empty
            <div class="text-gray-500">
                No todos yet.
            </div>
        @endforelse

    </div>
    </div>
</x-app-layout>

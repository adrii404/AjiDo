<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold mb-6 text-pink-800">
            Todo Planner
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- CREATE FORM --}}
        <div class="bg-white shadow rounded-xl p-6 mb-8">

            <form action="/todos" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter todo title"
                    >

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

                    <textarea
                        name="description"
                        rows="4"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Todo description..."
                    ></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Due Date
                    </label>

                    <input
                        type="date"
                        name="due_date"
                        class="border rounded-lg px-4 py-2"
                    >
                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg"
                >
                    Create Todo
                </button>
            </form>
        </div>

        <div class="space-y-4">

            @forelse($todos as $todo)
                <div class="bg-white shadow rounded-xl p-5">

                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold">
                            {{ $todo->title }}
                        </h2>

                        @if($todo->due_date)
                            <span class="text-sm text-gray-500">
                                {{ $todo->due_date }}
                            </span>
                        @endif
                    </div>

                    @if($todo->description)
                        <p class="text-gray-600 mt-2">
                            {{ $todo->description }}
                        </p>
                    @endif

                </div>
            @empty
                <div class="text-gray-500">
                    No todos yet.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>

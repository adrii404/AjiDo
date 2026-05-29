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

                        <div x-data="{
                            category: 'Personal',
                            subcategory: ''
                        }" class="space-y-4">

                            {{-- MAIN CATEGORY --}}
                            <div class="relative flex border-b">

                                <button type="button"
                                    @click="
                category = 'Personal';
                subcategory = '';
            "
                                    class="w-1/2 py-3 text-lg font-semibold transition"
                                    :class="category === 'Personal'
                                        ?
                                        'text-pink-700' :
                                        'text-gray-400'">
                                    Personal
                                </button>

                                <button type="button"
                                    @click="
                category = 'Professional';
                subcategory = 'Freelance';
            "
                                    class="w-1/2 py-3 text-lg font-semibold transition"
                                    :class="category === 'Professional'
                                        ?
                                        'text-pink-700' :
                                        'text-gray-400'">
                                    Professional
                                </button>

                                {{-- SLIDING UNDERLINE --}}
                                <div class="absolute bottom-0 h-1 bg-pink-600 rounded-full transition-all duration-300"
                                    :class="category === 'Personal'
                                        ?
                                        'left-0 w-1/2' :
                                        'left-1/2 w-1/2'">
                                </div>

                            </div>

                            {{-- PROFESSIONAL SUBCATEGORY --}}
                            <div x-show="category === 'Professional'" x-transition class="flex gap-3">

                                <button type="button" @click="subcategory = 'Freelance'"
                                    class="px-4 py-2 rounded-xl border transition"
                                    :class="subcategory === 'Freelance'
                                        ?
                                        'bg-pink-600 text-white border-pink-600' :
                                        'bg-white text-gray-600'">
                                    Freelance
                                </button>

                                <button type="button" @click="subcategory = 'Full Time'"
                                    class="px-4 py-2 rounded-xl border transition"
                                    :class="subcategory === 'Full Time'
                                        ?
                                        'bg-pink-600 text-white border-pink-600' :
                                        'bg-white text-gray-600'">
                                    Full Time
                                </button>

                            </div>

                            {{-- HIDDEN INPUTS --}}
                            <input type="hidden" name="category" :value="category">
                            <input type="hidden" name="subcategory" :value="subcategory">

                        </div>
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


    <div x-data="{
        tab: 'Personal',
        professionalTab: 'Freelance'
    }" class="mb-8">

        {{-- MAIN TABS --}}
        <div class="relative flex border-b mb-4">

            <button @click="tab = 'Personal'" class="w-1/2 py-3 text-lg font-semibold transition"
                :class="tab === 'Personal'
                    ?
                    'text-pink-700' :
                    'text-gray-400'">
                Personal
            </button>

            <button @click="tab = 'Professional'" class="w-1/2 py-3 text-lg font-semibold transition"
                :class="tab === 'Professional'
                    ?
                    'text-pink-700' :
                    'text-gray-400'">
                Professional
            </button>

            {{-- SLIDING INDICATOR --}}
            <div class="absolute bottom-0 h-1 bg-pink-600 rounded-full transition-all duration-300"
                :class="tab === 'Personal'
                    ?
                    'left-0 w-1/2' :
                    'left-1/2 w-1/2'">
            </div>

        </div>

        {{-- PROFESSIONAL SUB TABS --}}
        <div x-show="tab === 'Professional'" x-transition class="flex gap-3 mb-6">

            <button @click="professionalTab = 'Freelance'" class="px-4 py-2 rounded-xl border transition"
                :class="professionalTab === 'Freelance'
                    ?
                    'bg-pink-600 text-white' :
                    'bg-white text-gray-600'">
                Freelance
            </button>

            <button @click="professionalTab = 'Full Time'" class="px-4 py-2 rounded-xl border transition"
                :class="professionalTab === 'Full Time'
                    ?
                    'bg-pink-600 text-white' :
                    'bg-white text-gray-600'">
                Full Time
            </button>

        </div>

        {{-- TODOS --}}
        <div class="space-y-4">

            @foreach ($todos as $todo)
                {{-- PERSONAL TODOS --}}
                <div
                    x-show="
                    tab === 'Personal'
                    && '{{ $todo->category }}' === 'Personal'
                ">
                    <livewire:todo-toggle :todo="$todo" :key="$todo->id" />
                </div>

                {{-- PROFESSIONAL TODOS --}}
                <div
                    x-show="
                    tab === 'Professional'
                    && professionalTab === '{{ $todo->subcategory }}'
                ">
                    <livewire:todo-toggle :todo="$todo" :key="$todo->id" />
                </div>
            @endforeach

        </div>

    </div>
    <div class="flex justify-end">
        {{-- OPEN MODAL BUTTON --}}
        <button @click="open = true"
            class="fixed bottom-6 right-6 bg-pink-600 hover:bg-pink-700 text-white px-5 py-3 rounded-full shadow-lg z-50">
            + Create Todo
        </button>
    </div>

    </div>

</x-app-layout>

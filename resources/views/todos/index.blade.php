<x-app-layout>
    <div class="w-full py-10 px-6">
        <h1 class="text-3xl font-bold mb-6 text-pink-800">
            Todo Planner
        </h1>

        <div x-data="{
            open: false,
            editModal: false,
            tab: new URLSearchParams(window.location.search).get('tab') || 'Personal',
            professionalTab: new URLSearchParams(window.location.search).get('subcategory') || 'Freelance',
            createCategory: 'Personal',
            createSubcategory: '',
            editTodo: {
                id: null,
                title: '',
                description: '',
                category: 'Personal',
                subcategory: '',
                due_date: ''
            },
        
            get editAction() {
                return this.editTodo.id ? `/todos/${this.editTodo.id}` : '#';
            },
        
            updateUrl() {
                const params = new URLSearchParams();
                params.set('tab', this.tab);
        
                if (this.tab === 'Professional') {
                    params.set('subcategory', this.professionalTab);
                }
        
                history.replaceState({}, '', `${window.location.pathname}?${params}`);
            },
        
            openCreateModal() {
                this.createCategory = this.tab;
                this.createSubcategory = this.tab === 'Professional' ? this.professionalTab : '';
                this.open = true;
            },
        
            selectCreateCategory(category) {
                this.createCategory = category;
                this.createSubcategory = category === 'Professional' ? (this.professionalTab || 'Freelance') : '';
            },
        
            openEditModal(todo) {
                this.editTodo = {
                    id: todo.id,
                    title: todo.title || '',
                    description: todo.description || '',
                    category: todo.category || 'Personal',
                    subcategory: todo.category === 'Professional' ? (todo.subcategory || 'Freelance') : '',
                    due_date: todo.due_date || ''
                };
        
                this.editModal = true;
            },
        
            selectEditCategory(category) {
                this.editTodo.category = category;
                this.editTodo.subcategory = category === 'Professional' ? (this.editTodo.subcategory || 'Freelance') : '';
            }
        }" x-init="updateUrl()"
            x-on:open-edit-modal.window="openEditModal($event.detail.todo)">

            {{-- MAIN TABS --}}
            <div class="relative flex border-b mb-4">
                <button type="button" @click="tab = 'Personal'; updateUrl();"
                    class="w-1/2 py-3 text-lg font-semibold transition-all duration-300"
                    :class="tab === 'Personal'
                        ?
                        'text-pink-700' :
                        'text-gray-400 hover:text-gray-600'">
                    Personal
                </button>

                <button type="button" @click="tab = 'Professional'; updateUrl();"
                    class="w-1/2 py-3 text-lg font-semibold transition-all duration-300"
                    :class="tab === 'Professional'
                        ?
                        'text-pink-700' :
                        'text-gray-400 hover:text-gray-600'">
                    Professional
                </button>

                {{-- Sliding Indicator --}}
                <div class="absolute bottom-0 h-1 bg-pink-600 rounded-full
               transition-all duration-500 ease-in-out"
                    :class="tab === 'Personal'
                        ?
                        'left-0 w-1/2' :
                        'left-1/2 w-1/2'">
                </div>
            </div>

            {{-- RESERVED SPACE FOR PROFESSIONAL SUBTABS --}}
            <div x-bind:class="tab === 'Professional' ? 'max-h-20 mb-6' : 'max-h-0 mb-0'"
                class="overflow-hidden transition-all duration-500 ease-in-out">
                <div x-show="tab === 'Professional'" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95" class="flex gap-3">
                    <button type="button" @click="professionalTab = 'Freelance'; updateUrl();"
                        class="px-4 py-2 rounded-full border transition-all duration-300"
                        :class="professionalTab === 'Freelance'
                            ?
                            'bg-pink-600 text-white border-pink-600 shadow-sm' :
                            'bg-white text-gray-600 hover:bg-pink-50'">
                        Freelance
                    </button>

                    <button type="button" @click="professionalTab = 'Full Time'; updateUrl();"
                        class="px-4 py-2 rounded-full border transition-all duration-300"
                        :class="professionalTab === 'Full Time'
                            ?
                            'bg-pink-600 text-white border-pink-600 shadow-sm' :
                            'bg-white text-gray-600 hover:bg-pink-50'">
                        Full Time
                    </button>
                </div>
            </div>
            {{-- FLOATING CREATE BUTTON --}}
            <button type="button" @click="openCreateModal()"
                class="fixed bottom-6 right-6 bg-pink-600 hover:bg-pink-700 text-white px-6 py-4 rounded-full shadow-xl z-50 transition hover:scale-105">
                + Create Todo
            </button>

            {{-- CREATE MODAL --}}
            <div x-show="open" x-transition x-cloak
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div @click.outside="open = false" class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-pink-800">
                            Create Todo
                        </h2>

                        <button type="button" @click="open = false" class="text-gray-500 hover:text-black text-xl">
                            &times;
                        </button>
                    </div>

                    <form action="/todos" method="POST" class="space-y-4">
                        @csrf

                        <input type="hidden" name="redirect_tab" :value="createCategory">
                        <input type="hidden" name="redirect_subcategory" :value="createSubcategory">

                        <div>
                            <label class="block text-sm font-medium mb-1">Title</label>
                            <input type="text" name="title" class="w-full border rounded-lg px-4 py-2"
                                placeholder="Enter todo title" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2"></textarea>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Category</label>
                                <div class="relative flex border-b">
                                    <button type="button" @click="selectCreateCategory('Personal')"
                                        class="w-1/2 py-3 text-lg font-semibold transition"
                                        :class="createCategory === 'Personal' ? 'text-pink-700' : 'text-gray-400'">
                                        Personal
                                    </button>

                                    <button type="button" @click="selectCreateCategory('Professional')"
                                        class="w-1/2 py-3 text-lg font-semibold transition"
                                        :class="createCategory === 'Professional' ? 'text-pink-700' : 'text-gray-400'">
                                        Professional
                                    </button>

                                    <div class="absolute bottom-0 h-1 bg-pink-600 rounded-full transition-all duration-300"
                                        :class="createCategory === 'Personal' ? 'left-0 w-1/2' : 'left-1/2 w-1/2'">
                                    </div>
                                </div>
                            </div>

                            <div x-show="createCategory === 'Professional'" x-transition class="flex gap-3">
                                <button type="button" @click="createSubcategory = 'Freelance'"
                                    class="px-4 py-2 rounded-xl border transition"
                                    :class="createSubcategory === 'Freelance' ? 'bg-pink-600 text-white border-pink-600' :
                                        'bg-white text-gray-600'">
                                    Freelance
                                </button>

                                <button type="button" @click="createSubcategory = 'Full Time'"
                                    class="px-4 py-2 rounded-xl border transition"
                                    :class="createSubcategory === 'Full Time' ? 'bg-pink-600 text-white border-pink-600' :
                                        'bg-white text-gray-600'">
                                    Full Time
                                </button>
                            </div>

                            <input type="hidden" name="category" :value="createCategory">
                            <input type="hidden" name="subcategory" :value="createSubcategory">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Due Date</label>
                            <input type="date" name="due_date" value="{{ now()->format('Y-m-d') }}"
                                class="w-full border rounded-lg px-4 py-2">
                            <div>
                                <label class="block text-sm font-medium mb-1">Due Time</label>
                                <input type="time" name="due_at" class="w-full border rounded-lg px-4 py-2">
                            </div>
                        </div>


                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="open = false" class="px-4 py-2 rounded-lg border">
                                Cancel
                            </button>

                            <button type="submit"
                                class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded-lg">
                                Create Todo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- EDIT MODAL --}}
            <div x-show="editModal" x-transition x-cloak
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div @click.outside="editModal = false" class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-pink-800">
                            Edit Todo
                        </h2>

                        <button type="button" @click="editModal = false"
                            class="text-gray-500 hover:text-black text-xl">
                            &times;
                        </button>
                    </div>

                    <form :action="editAction" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="redirect_tab" :value="editTodo.category">
                        <input type="hidden" name="redirect_subcategory" :value="editTodo.subcategory">

                        <div>
                            <label class="block text-sm font-medium mb-1">Title</label>
                            <input type="text" name="title" x-model="editTodo.title"
                                class="w-full border rounded-lg px-4 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Description</label>
                            <textarea name="description" rows="4" x-model="editTodo.description"
                                class="w-full border rounded-lg px-4 py-2"></textarea>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Category</label>
                                <div class="relative flex border-b">
                                    <button type="button" @click="selectEditCategory('Personal')"
                                        class="w-1/2 py-3 text-lg font-semibold transition"
                                        :class="editTodo.category === 'Personal' ? 'text-pink-700' : 'text-gray-400'">
                                        Personal
                                    </button>

                                    <button type="button" @click="selectEditCategory('Professional')"
                                        class="w-1/2 py-3 text-lg font-semibold transition"
                                        :class="editTodo.category === 'Professional' ? 'text-pink-700' : 'text-gray-400'">
                                        Professional
                                    </button>

                                    <div class="absolute bottom-0 h-1 bg-pink-600 rounded-full transition-all duration-300"
                                        :class="editTodo.category === 'Personal' ? 'left-0 w-1/2' : 'left-1/2 w-1/2'">
                                    </div>
                                </div>
                            </div>

                            <div x-show="editTodo.category === 'Professional'" x-transition class="flex gap-3">
                                <button type="button" @click="editTodo.subcategory = 'Freelance'"
                                    class="px-4 py-2 rounded-xl border transition"
                                    :class="editTodo.subcategory === 'Freelance' ? 'bg-pink-600 text-white border-pink-600' :
                                        'bg-white text-gray-600'">
                                    Freelance
                                </button>

                                <button type="button" @click="editTodo.subcategory = 'Full Time'"
                                    class="px-4 py-2 rounded-xl border transition"
                                    :class="editTodo.subcategory === 'Full Time' ? 'bg-pink-600 text-white border-pink-600' :
                                        'bg-white text-gray-600'">
                                    Full Time
                                </button>
                            </div>

                            <input type="hidden" name="category" :value="editTodo.category">
                            <input type="hidden" name="subcategory" :value="editTodo.subcategory">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Due Date</label>
                            <input type="date" name="due_date" x-model="editTodo.due_date"
                                class="w-full border rounded-lg px-4 py-2">
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="editModal = false" class="px-4 py-2 rounded-lg border">
                                Cancel
                            </button>

                            <button type="submit"
                                class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded-lg">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- TODOS --}}
            <div class="space-y-4">
                @foreach ($todos as $todo)
                    <div
                        x-show="
                            (tab === 'Personal' && @js($todo->category) === 'Personal')
|| (tab === 'Professional' && professionalTab === @js($todo->subcategory))
                        ">
                        <livewire:todo-toggle :todo="$todo" :key="$todo->id" />
                    </div>
                @endforeach
            </div>
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2200,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif
    </div>
</x-app-layout>

<div x-data="{ 
    completed: {{ $todo->completed ? 'true' : 'false' }},
    todoId: {{ $todo->id }},
    
    async toggle() {
        // INSTANT UI update - no delay at all!
        this.completed = !this.completed;
        
        // Fire and forget - update database in background
        fetch(`/todos/${this.todoId}/toggle`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ completed: this.completed })
        }).catch(error => {
            // Optional: revert on error
            this.completed = !this.completed;
            console.error('Failed to save:', error);
        });
    }
}" 
class="bg-white shadow rounded-xl p-5">

    <div class="flex items-start justify-between gap-4">

        <div class="flex items-start gap-3">

            <input
                type="checkbox"
                @click="toggle"
                x-model="completed"
                class="mt-1 w-5 h-5 cursor-pointer"
            >

            <div>

                <div class="flex gap-2">

                    <h2 class="text-xl font-semibold" :class="{ 'line-through text-gray-400': completed, '': !completed }">
                        {{ $todo->title }}
                    </h2>

                    <span class="
                        px-3 py-2 rounded-full text-xs font-semibold

                        {{ $todo->category === 'Freelance'
                            ? 'bg-purple-100 text-purple-700'
                            : 'bg-blue-100 text-blue-700'
                        }}
                    ">
                        {{ $todo->category }}
                    </span>

                </div>

                @if ($todo->description)
                    <p class="mt-2" :class="{ 'text-gray-400 line-through': completed, 'text-gray-600': !completed }">
                        {{ $todo->description }}
                    </p>
                @endif

            </div>

        </div>

        @if ($todo->due_date)
            <span class="text-sm text-gray-500">
                {{ $todo->due_date }}
            </span>
        @endif

    </div>

</div>
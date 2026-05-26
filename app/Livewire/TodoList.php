<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoList extends Component
{
    public $title = '';
    public $description = '';
    public $due_date = '';

    public function createTodo()
    {
        $this->validate([
            'title' => 'required|min:3',
        ]);

        Todo::create([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'category' => $this->category,
            'completed' => false,
        ]);

        $this->reset([
            'title',
            'description',
            'due_date'
        ]);
    }

    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->completed = !$todo->completed;

        $todo->save();
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->get()
        ]);
    }
}
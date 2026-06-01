<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoToggle extends Component
{
    public Todo $todo;
    public $completed;
    public function mount(Todo $todo)
    {
        $this->todo = $todo;
        $this->completed = $todo->completed;
    }

    public function toggle()
    {
        $this->todo->update([
            'completed' => !$this->todo->completed
        ]);
        $this->completed = $this->todo->completed;
    }

    public function openEditModal()
    {
        $this->dispatch('open-edit-modal', todo: [
            'id' => $this->todo->id,
            'title' => $this->todo->title,
            'description' => $this->todo->description,
            'category' => $this->todo->category,
            'subcategory' => $this->todo->subcategory,
            'due_date' => $this->todo->due_date,
        ]);
    }

    public function render()
    {
        return view('livewire.todo-toggle');
    }
}

<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoToggle extends Component
{
    public Todo $todo;
    public $completed = false;

    public function mount(Todo $todo)
    {
        $this->todo = $todo;
        $this->completed = $todo->completed;
    }

    public function toggle()
    {
        // Immediately update the UI (optimistic)
        $this->completed = !$this->completed;
        
        // Then update the database
        $this->todo->update([
            'completed' => $this->completed
        ]);
    }

    public function render()
    {
        return view('livewire.todo-toggle');
    }
}
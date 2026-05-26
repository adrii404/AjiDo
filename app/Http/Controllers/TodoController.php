<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        Todo::create($validated);

        return redirect()
        ->back()
        ->with('success', 'To-do created successfully!');
    }

    public function toggle(Todo $todo){
        $todo->completed = !$todo->completed;

        $todo->save();

        return back();
    }
}

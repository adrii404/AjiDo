<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'required|in:Personal,Professional',
            'subcategory' => 'nullable|string',
            'due_date' => 'nullable|date',
            'due_at' => 'nullable|date_format:H:i',
        ]);

        $validated['subcategory'] = $validated['category'] === 'Professional'
            ? ($validated['subcategory'] ?: 'Freelance')
            : null;

        if ($request->filled('due_date')) {
            $validated['due_at'] = $request->due_date;

            if ($request->filled('due_at')) {
                $validated['due_at'] .= ' ' . $request->due_at;
            }
        }
        Todo::create($validated);

        return $this->redirectToTodoTab($validated['category'], $validated['subcategory'])
            ->with('success', 'Todo created!');
    }

    public function toggle(Todo $todo)
    {
        $todo->completed = !$todo->completed;

        $todo->save();

        return back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()
            ->back()
            ->with('success', 'Todo deleted!');
    }

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'required|in:Personal,Professional',
            'subcategory' => 'nullable|string',
            'due_date' => 'nullable|date',
            'due_at' => 'nullable|date_format:H:i',
        ]);

        $validated['subcategory'] = $validated['category'] === 'Professional'
            ? ($validated['subcategory'] ?: 'Freelance')
            : null;

        $todo->update($validated);

        return $this->redirectToTodoTab($validated['category'], $validated['subcategory'])
            ->with('success', 'Todo Updated!');
    }

    private function redirectToTodoTab(string $category, ?string $subcategory)
    {
        $query = ['tab' => $category];

        if ($category === 'Professional') {
            $query['subcategory'] = $subcategory ?: 'Freelance';
        }

        return redirect('/todos?' . http_build_query($query));
    }
}

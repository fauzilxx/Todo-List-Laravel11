<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Task::count(),
            'completed' => Task::completed()->count(),
            'today' => Task::today()->count(),
            'overdue' => Task::overdue()->count(),
        ];

        $activeTasks = Task::active()->orderBy('deadline', 'asc')->get();
        $completedTasks = Task::completed()->orderBy('updated_at', 'desc')->get();

        return view('index', compact('stats', 'activeTasks', 'completedTasks'));
    }

    public function toggle(Task $task)
    {
        $task->update([
            'is_done' => !$task->is_done
        ]);

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'type' => 'nullable|string',
            'urgency' => 'nullable|string',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $tags = null;
        if ($request->tags) {
            $tags = array_map('trim', explode(',', $request->tags));
        }

        Task::create([
            'title' => $request->title,
            'type' => $request->type,
            'urgency' => $request->urgency,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'tags' => $tags,
        ]);

        return redirect('/')->with('success', 'Task berhasil ditambahkan!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Task berhasil dihapus!');
    }
}

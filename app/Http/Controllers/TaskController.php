<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total' => $user->tasks()->count(),
            'completed' => $user->tasks()->completed()->count(),
            'today' => $user->tasks()->today()->count(),
            'overdue' => $user->tasks()->overdue()->count(),
        ];

        $activeTasks = $user->tasks()->active()->orderBy('deadline', 'asc')->get();
        $completedTasks = $user->tasks()->completed()->orderBy('updated_at', 'desc')->get();

        return view('index', compact('stats', 'activeTasks', 'completedTasks'));
    }

    public function toggle(Task $task)
    {
        // Ensure the task belongs to the user
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'completed' => !$task->completed
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

        Auth::user()->tasks()->create([
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
        // Ensure the task belongs to the user
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return back()->with('success', 'Task berhasil dihapus!');
    }
}

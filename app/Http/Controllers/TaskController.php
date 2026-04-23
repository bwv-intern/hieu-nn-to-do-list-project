<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo) {
        $this->taskRepo = $taskRepo;
    }

    /**
     * Display a list of tasks
     */
    public function index() {
        $tasks = $this->taskRepo->getAllForUser(auth()->id());
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the create task form
     */
    public function create() {
        // Only get categories that belong to the authenticated user
        $categories = Category::where('user_id', auth()->id())->get();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a new task
     */
    public function store(TaskRequest $request) {
        // Observer will automatically assign user_id
        $this->taskRepo->create($request->validated());
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Show the edit form
     */
    public function edit($id) {
        $task = $this->taskRepo->find($id);

        // Check ownership (prevent users from modifying other users' tasks via URL)
        if ($task->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to edit this task.');
        }

        $categories = Category::where('user_id', auth()->id())->get();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update a task
     */
    public function update(TaskRequest $request, $id) {
        $task = $this->taskRepo->find($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $this->taskRepo->update($id, $request->validated());
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Delete a task
     */
    public function destroy($id) {
        $task = $this->taskRepo->find($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $this->taskRepo->delete($id);
        
        return redirect()->back()
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Extra method: Toggle task status (Pending <-> Completed)
     */
    public function toggleStatus($id) {
        $task = $this->taskRepo->find($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $newStatus = $task->status === 'pending' ? 'completed' : 'pending';
        $this->taskRepo->update($id, ['status' => $newStatus]);

        return redirect()->back()
            ->with('success', 'Task status updated!');
    }
}

<?php 

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface {
    public function getAllForUser($userId) {
        return Task::where('user_id', $userId)
                    // Load the Category beforehand to display the name
                   ->with('category') 
                   ->latest()
                   ->get();
    }

    public function create(array $data) {
        return Task::create($data);
    }

    public function update($id, array $data) {
        $task = Task::where('id', $id)
                // Only allow if it's the rightful owner
                ->where('user_id', auth()->id()) 
                ->firstOrFail();
        $task->update($data);
        return $task;
    }

    public function delete($id) {
        return Task::destroy($id);
    }

    public function find($id) {
        return Task::findOrFail($id);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Component
{
    public $label = '';
    public $scheduled_at = '';

    public function addTask()
    {
        // 1. Validation
        $this->validate([
            'label' => 'required|min:3',
            'scheduled_at' => 'required',
        ]);

        // 2. Création de la tâche
        Task::create([
            'user_id' => Auth::id(),
            'label' => $this->label,
            'scheduled_at' => $this->scheduled_at,
        ]);

        // 3. Reset des champs
        $this->reset(['label', 'scheduled_at']);
    }

    public function render()
    {
        $tasks = Task::where('user_id', auth()->id())->orderBy('scheduled_at', 'asc')->get();

        // Calcul du pourcentage
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('is_completed', true)->count();
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return view('livewire.task-manager', [
            'tasks' => $tasks,
            'progress' => $progress
        ]);
    }

    public function toggleTask($taskId)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($taskId);
        $task->update([
            'is_completed' => !$task->is_completed
        ]);
    }

    public function deleteTask($taskId)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($taskId);
        $task->delete();
    }
}

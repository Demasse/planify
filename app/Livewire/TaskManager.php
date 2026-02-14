<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Component
{
    public $label = '';
    public $scheduled_at = '';
    public $filter = 'all'; // Valeurs possibles : all, todo, completed

    public function addTask()
    {
        $this->validate([
            'label' => 'required|min:3',
            'scheduled_at' => 'required',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'label' => $this->label,
            'scheduled_at' => $this->scheduled_at,
        ]);

        $this->reset(['label', 'scheduled_at']);

        // Envoi de la notification
        $this->dispatch('notify', message: 'Tâche ajoutée avec succès !');
    }

    public function toggleTask($taskId)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        $message = $task->is_completed ? 'Tâche terminée ! 🎉' : 'Tâche remise à faire.';
        $this->dispatch('notify', message: $message);
    }

    public function deleteTask($taskId)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);
        $task->delete();

        $this->dispatch('notify', message: 'Tâche supprimée.');
    }

    public function render()
    {
        $query = Task::where('user_id', Auth::id())->orderBy('scheduled_at', 'asc');

        if ($this->filter === 'todo') {
            $query->where('is_completed', false);
        } elseif ($this->filter === 'completed') {
            $query->where('is_completed', true);
        }

        $tasks = $query->get();

        $total = Task::where('user_id', Auth::id())->count();
        $done = Task::where('user_id', Auth::id())->where('is_completed', true)->count();
        $progress = $total > 0 ? round(($done / $total) * 100) : 0;

        return view('livewire.task-manager', [
            'tasks' => $tasks,
            'progress' => $progress
        ]);
    }
}

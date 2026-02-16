<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskManager extends Component
{
    public $label = '';
    public $scheduled_at = '';
    public $filter = 'all';
    public $selectedDate; // Stocke la date affichée (format YYYY-MM-DD)

    /**
     * Initialisation au chargement du composant
     */
    public function mount()
    {
        // Par défaut, on affiche les tâches d'aujourd'hui
        $this->selectedDate = Carbon::today()->toDateString();
    }

    /**
     * Navigation vers le jour précédent
     */
    public function previousDay()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subDay()->toDateString();
    }

    /**
     * Navigation vers le jour suivant
     */
    public function nextDay()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->addDay()->toDateString();
    }

    /**
     * Retour rapide à aujourd'hui
     */
    public function goToToday()
    {
        $this->selectedDate = Carbon::today()->toDateString();
    }

    /**
     * Ajout d'une nouvelle tâche
     */
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
            'scheduled_date' => $this->selectedDate, // La tâche est liée au jour visualisé
            'is_completed' => false,
        ]);

        $this->reset(['label', 'scheduled_at']);

        $this->dispatch('notify', message: 'Tâche planifiée avec succès !');
    }

    /**
     * Cocher / Décocher une tâche
     */
    public function toggleTask($taskId)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        $message = $task->is_completed ? 'Tâche terminée ! 🎉' : 'Tâche remise à faire.';
        $this->dispatch('notify', message: $message);
    }

    /**
     * Supprimer une tâche
     */
    public function deleteTask($taskId)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);
        $task->delete();

        $this->dispatch('notify', message: 'Tâche supprimée.');
    }

    /**
     * Rendu de la vue
     */

    public $search = '';

    public function render()
    {
        // On commence par la base : les tâches de l'utilisateur connecté
        $query = Task::where('user_id', Auth::id());

        // 1. LOGIQUE DE RECHERCHE
        if (!empty($this->search)) {
            // Si on cherche, on regarde partout sans filtrer par date
            $query->where('label', 'like', '%' . $this->search . '%');
        } else {
            // Sinon, on affiche uniquement le jour choisi dans le calendrier
            $query->whereDate('scheduled_date', $this->selectedDate);
        }

        // 2. Application du filtre d'état (Toutes, À faire, Faites)
        if ($this->filter === 'todo') {
            $query->where('is_completed', false);
        } elseif ($this->filter === 'completed') {
            $query->where('is_completed', true);
        }

        // On récupère les résultats triés par heure
        $tasks = $query->orderBy('scheduled_at', 'asc')->get();

        // 3. Calcul de la progression (Toujours basée sur le jour sélectionné)
        $totalToday = Task::where('user_id', Auth::id())
            ->whereDate('scheduled_date', $this->selectedDate)
            ->count();

        $doneToday = Task::where('user_id', Auth::id())
            ->whereDate('scheduled_date', $this->selectedDate)
            ->where('is_completed', true)
            ->count();

        $progress = $totalToday > 0 ? round(($doneToday / $totalToday) * 100) : 0;

        return view('livewire.task-manager', [
            'tasks' => $tasks,
            'progress' => $progress
        ]);
    }
}

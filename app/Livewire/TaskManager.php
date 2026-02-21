<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Attributes\On; // <--- MODIFICATION ICI : Importation pour l'écouteur d'événements

class TaskManager extends Component
{
    public $label = '';
    public $scheduled_at = '';
    public $filter = 'all';
    public $selectedDate;

    /**
     * MODIFICATION ICI : Écouteur d'événement
     * Cette fonction se déclenche dès que le calendrier envoie 'date-updated'
     */
    #[On('date-updated')]
    public function updateSelectedDate($date)
    {
        $this->selectedDate = $date;
        // Le rendu (render) se lancera automatiquement, filtrant les tâches
        // et affichant une "page blanche" s'il n'y a rien pour cette date.
    }

    public function mount()
    {
        $this->selectedDate = Carbon::today()->toDateString();
    }

    /**
     * Navigation manuelle (via les flèches du TaskManager)
     */
    public function previousDay()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subDay()->toDateString();
    }

    public function nextDay()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->addDay()->toDateString();
    }

    public function goToToday()
    {
        $this->selectedDate = Carbon::today()->toDateString();
    }

    /**
     * Ajout d'une nouvelle tâche
     * Note : Elle sera automatiquement liée à la date choisie sur le calendrier
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
            // Utilise la date actuellement sélectionnée (cliquée sur le calendrier)
            'scheduled_date' => Carbon::parse($this->selectedDate)->format('Y-m-d'),
            'is_completed' => false,
        ]);

        $this->reset(['label', 'scheduled_at']);
        $this->dispatch('notify', message: 'Tâche planifiée avec succès !', type: 'success');
    }

    public function toggleTask($taskId)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);
        $user = Auth::user();
        $today = now()->startOfDay();

        $task->is_completed = !$task->is_completed;
        $task->save();

        if ($task->is_completed) {
            $user->increment('xp', 10);

            // --- LOGIQUE DES STREAKS ---
            $lastActivity = $user->last_activity_date ? \Carbon\Carbon::parse($user->last_activity_date)->startOfDay() : null;

            if (!$lastActivity) {
                // Première fois qu'il finit une tâche
                $user->streak_count = 1;
            } else {
                $diffInDays = $today->diffInDays($lastActivity);

                if ($diffInDays == 1) {
                    // C'était hier ! La série continue
                    $user->streak_count += 1;
                    $this->dispatch('notify', message: "SÉRIE CONTINUÉE ! 🔥");
                } elseif ($diffInDays > 1) {
                    // Trop tard, la flamme s'était éteinte
                    $user->streak_count = 1;
                }
                // Si $diffInDays == 0 (aujourd'hui), on ne change rien, la série est déjà active
            }

            $user->last_activity_date = $today;
            $user->save();

            // ... (ton code précédent pour le Level Up et Half Way)
        } else {
            $user->decrement('xp', 10);
            $user->save();
        }
    }

    public function deleteTask($taskId)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);
        $task->delete();
        $this->dispatch('notify', message: 'Tâche supprimée.');
    }

    public $search = '';

    public function render()
    {
        $query = Task::where('user_id', Auth::id());

        if (!empty($this->search)) {
            $query->where('label', 'like', '%' . $this->search . '%');
        } else {
            // Filtre automatique : on ne voit que les tâches du jour choisi
            $query->whereDate('scheduled_date', $this->selectedDate);
        }

        if ($this->filter === 'todo') {
            $query->where('is_completed', false);
        } elseif ($this->filter === 'completed') {
            $query->where('is_completed', true);
        }

        $tasks = $query->orderBy('scheduled_at', 'asc')->get();

        // Calcul de progression dynamique basé sur la date du calendrier
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

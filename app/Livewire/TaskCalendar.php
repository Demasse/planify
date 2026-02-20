<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskCalendar extends Component
{
    public $currentDate; // La date qui définit le mois affiché
    public $selectedDate; // Le jour sur lequel l'utilisateur a cliqué
    public $newTaskTitle = '';

    public function mount()
    {
        // Au démarrage, on affiche le mois actuel et on sélectionne aujourd'hui
        $this->currentDate = Carbon::now();
        $this->selectedDate = Carbon::today()->format('Y-m-d');
    }

    // Aller au mois précédent
    public function previousMonth()
    {
        $this->currentDate = Carbon::parse($this->currentDate)->subMonth();
    }

    // Aller au mois suivant
    public function nextMonth()
    {
        $this->currentDate = Carbon::parse($this->currentDate)->addMonth();
    }

    // Sélectionner un jour précis
    public function selectDate($date)
    {
        $this->selectedDate = $date;

        // On envoie l'événement à tout le dashboard
        $this->dispatch('date-updated', date: $date);
    }

    // Ajouter une tâche pour le jour sélectionné
    public function addTask()
    {
        $this->validate([
            'newTaskTitle' => 'required|min:3|max:255',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->newTaskTitle,
            'scheduled_date' => $this->selectedDate, // On utilise la date sélectionnée
            'is_completed' => false,
        ]);

        $this->newTaskTitle = ''; // On vide le champ

        $this->dispatch('notify', message: 'Tâche ajoutée avec succès ! 📝', type: 'success');
    }

    public function render()
    {
        $startOfMonth = Carbon::parse($this->currentDate)->startOfMonth();
        $endOfMonth = Carbon::parse($this->currentDate)->endOfMonth();

        // On génère tous les jours du mois pour la grille
        $days = [];
        $date = $startOfMonth->copy();

        while ($date <= $endOfMonth) {
            $days[] = [
                'full' => $date->format('Y-m-d'),
                'day' => $date->day,
                'isToday' => $date->isToday(),
            ];
            $date->addDay();
        }

        // On récupère les tâches du jour sélectionné uniquement
        $tasks = Task::where('user_id', Auth::id())
            ->whereDate('scheduled_date', $this->selectedDate)
            ->latest()
            ->get();

        return view('livewire.task-calendar', [
            'days' => $days,
            'tasks' => $tasks,
            'monthName' => $startOfMonth->translatedFormat('F Y'), // Ex: "Février 2026"
        ]);
    }

}

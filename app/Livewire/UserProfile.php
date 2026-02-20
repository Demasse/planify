<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    use WithFileUploads;

    public $photo;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048',
        ]);

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // 1. On prépare un nom UNIQUE avec le timestamp
            $name = 'avatar-' . $user->id . '-' . now()->timestamp . '.' . $this->photo->getClientOriginalExtension();

            // 2. On supprime l'ANCIENNE photo du serveur si elle existe
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // 3. On stocke la NOUVELLE photo
            $path = $this->photo->storeAs('profile-photos', $name, 'public');

            // 4. Mise à jour de la base de données
            $user->profile_photo_path = $path;
            $user->save();

            // Signal de succès pour ta bulle de notification
            $this->dispatch('notify', message: 'Photo mise à jour ! 🚀', type: 'success');

            // Rafraîchissement forcé après 1s pour que le navigateur charge le nouveau nom
            $this->js('setTimeout(() => { window.location.reload() }, 1000)');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Erreur : ' . $e->getMessage(), type: 'error');
        }
    }

    public function deletePhoto()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->profile_photo_path) {
            // Supprime le fichier physique
            Storage::disk('public')->delete($user->profile_photo_path);

            // Met à jour la base de données
            $user->update([
                'profile_photo_path' => null
            ]);

            // Notification
            $this->dispatch('notify', message: 'Photo supprimée avec succès !', type: 'info');

            // Rafraîchit pour afficher l'avatar par défaut
            $this->js('setTimeout(() => { window.location.reload() }, 1000)');
        }
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

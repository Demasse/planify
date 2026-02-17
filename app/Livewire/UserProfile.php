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

            $name = 'avatar-' . $user->id . '.' . $this->photo->getClientOriginalExtension();
            $path = $this->photo->storeAs('profile-photos', $name, 'public');

            $user->profile_photo_path = $path;
            $user->save();

            // On envoie le signal DIRECTEMENT au navigateur
            $this->dispatch('notify', message: 'Photo mise à jour ! 🚀', type: 'success');

            // Au lieu d'un redirect PHP, on va dire au navigateur de se rafraîchir dans 1 seconde
            // Cela laisse le temps à la bulle d'apparaître et au son de jouer
            $this->js('setTimeout(() => { window.location.reload() }, 1000)');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Erreur : ' . $e->getMessage(), type: 'error');
        }
    }
    // public function deletePhoto()
    // {
    //     /** @var \App\Models\User $user */ // <-- Cette ligne dit à VS Code : "T'inquiète, c'est mon modèle User"
    //     $user = Auth::user();

    //     if ($user->profile_photo_path) {
    //         // Supprime le fichier physique
    //         Storage::disk('public')->delete($user->profile_photo_path);

    //         // Met à jour la base de données (le rouge devrait disparaître maintenant)
    //         $user->update([
    //             'profile_photo_path' => null
    //         ]);

    //         // Notification de suppression
    //         session()->flash('notify', [
    //             'message' => 'Photo supprimée.',
    //             'type' => 'info'
    //         ]);
    //     }

    //     return redirect(route('profile'));
    // }
    public function deletePhoto()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->profile_photo_path) {
            // 1. Supprime le fichier physique
            Storage::disk('public')->delete($user->profile_photo_path);

            // 2. Met à jour la base de données
            $user->update([
                'profile_photo_path' => null
            ]);

            // 3. Envoie le signal de notification immédiatement
            $this->dispatch('notify', message: 'Photo supprimée avec succès !', type: 'info');

            // 4. Rafraîchit la page après 1 seconde pour voir le résultat
            $this->js('setTimeout(() => { window.location.reload() }, 1000)');
        }
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

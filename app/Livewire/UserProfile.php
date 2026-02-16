<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Indispensable pour les fichiers
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    use WithFileUploads;

    public $photo;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // Max 1Mo
        ]);

        $user = Auth::user();

        // Supprimer l'ancienne photo si elle existe
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Sauvegarder la nouvelle
        $path = $this->photo->store('profile-photos', 'public');

        $user->update([
            'profile_photo_path' => $path
        ]);

        $this->dispatch('notify', message: 'Photo mise à jour !');
    }

    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->update(['profile_photo_path' => null]);
        }

        $this->dispatch('notify', message: 'Photo supprimée.');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

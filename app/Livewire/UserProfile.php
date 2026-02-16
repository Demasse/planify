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
            /** @var \App\Models\User $user */ // <--- AJOUTE CETTE LIGNE (C'est un indice pour l'éditeur)
            $user = Auth::user();

            $name = 'avatar-' . $user->id . '.' . $this->photo->getClientOriginalExtension();
            $path = $this->photo->storeAs('profile-photos', $name, 'public');

            $user->profile_photo_path = $path;
            $user->save(); // <--- Le rouge devrait disparaître ici !

            return redirect(route('profile'));
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function deletePhoto()
    {
        /** @var \App\Models\User $user */ // <-- Cette ligne dit à VS Code : "T'inquiète, c'est mon modèle User"
        $user = Auth::user();

        if ($user->profile_photo_path) {
            // Supprime le fichier physique
            Storage::disk('public')->delete($user->profile_photo_path);

            // Met à jour la base de données (le rouge devrait disparaître maintenant)
            $user->update([
                'profile_photo_path' => null
            ]);
        }

        return redirect(route('profile'));
    }
    public function render()
    {
        return view('livewire.user-profile');
    }
}

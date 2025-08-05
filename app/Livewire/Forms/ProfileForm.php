<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class ProfileForm extends Form
{
    use WithFileUploads;

    #[Validate('required|string|max:255', message: 'Nama wajib diisi dan maksimal 255 karakter.')]
    public $name;

    #[Validate('required|email|max:255|unique:users,email', message: 'Email wajib diisi, harus valid, dan belum terdaftar.', onUpdate: false)]
    public $email;

    #[Validate(['nullable', 'min:4'], onUpdate: false)]
    public string $password = '';

    #[Validate('nullable|image|max:2048', message: 'Foto harus berupa gambar dengan ukuran maksimal 2MB.')]
    public $photo;

    public function update(): bool
    {

        $user = auth()->user();
        // Validate the form data
        $validated = $this->validate([
            'name' => ['required', 'max:50'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'photo' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        // Prepare updates only for changed fields
        $updates = [];
        if ($this->name !== $user->name) {
            $updates['name'] = $this->name;
        }
        if ($this->email !== $user->email) {
            $updates['email'] = $this->email;
        }
        if (! empty($this->password)) {
            $updates['password'] = Hash::make($this->password);
        }

        if ($this->photo) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            // Store new photo
            $path = $this->photo->store('photos', 'public');
            $updates['photo'] = $path;
        }

        // Perform update only if there are changes
        if (! empty($updates)) {
            $user->update($updates);

            return true;
        }

        return false; // No changes made
    }
}

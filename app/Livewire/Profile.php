<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\WithNotify;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Livewire\Forms\ProfileForm;
use Livewire\WithFileUploads;

#[Title('Profile')]
class Profile extends Component
{
    use WithNotify;
    use WithFileUploads;

    public ProfileForm $form;

    public User $user;


    public function mount()
    {

        $this->user = User::find(auth()->user()->id);

        $this->form->name = $this->user->name;
        $this->form->email = $this->user->email;
    }

    public function edit()
    {
        if ($this->form->update()) {

            $this->notifySuccess('Berhasil menyimpan perubahan profile');
        }

    }
    public function render()
    {
        return view('livewire.profile');
    }
}

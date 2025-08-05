<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('layouts.guest')]
class Login extends Component
{

    #[Rule(['required', 'email', 'exists:users,email'])]
    public string $email = '';

    #[Rule(['required'])]
    public string $password = '';

    public function submit() {

        if(Auth::attempt($this->validate())) {
            redirect()->route('index');
        }

        flash('Email atau password tidak valid', 'danger');


    }

    public function render()
    {
        return view('livewire.login');
    }
}

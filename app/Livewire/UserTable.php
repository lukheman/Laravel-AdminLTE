<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserTable extends Component
{
    public $model = User::class;
    public $columns = [
        ['field' => 'name', 'label' => 'Nama Lengkap'],
        ['field' => 'email', 'label' => 'Alamat Email'],
        ['field' => 'created_at', 'label' => 'Tanggal Dibuat'],
    ];
    public $formFields = [
        ['field' => 'name', 'label' => 'Nama Lengkap'],
        ['field' => 'email', 'label' => 'Alamat Email']
    ];
    public $rules = [
        'form.name' => 'required|string|max:255',
        'form.email' => 'required|email|unique:users,email',
    ];


    public function render()
    {
        return view('livewire.user-table');
    }
}

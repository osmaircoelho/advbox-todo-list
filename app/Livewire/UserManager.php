<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public function render()
    {
        return view('livewire.user-manager', [
            'users' => User::latest()->paginate(5)
        ])->layout('layouts.app');
    }
}

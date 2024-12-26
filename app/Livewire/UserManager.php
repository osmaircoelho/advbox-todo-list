<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $user_id;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $messages = [
        'name.required' => 'The name is required.',
        'name.string' => 'The name must be a string.',
        'name.max' => 'The name must not exceed 255 characters.',
        'email.required' => 'The email is required.',
        'email.string' => 'The email must be a string.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'The email must not exceed 255 characters.',
        'email.unique' => 'This email is already in use.',
        'password.required' => 'The password is required.',
        'password.string' => 'The password must be a string.',
        'password.min' => 'The password must be at least 8 characters.',
        'password.confirmed' => 'The password confirmation does not match.',
    ];

    public function render()
    {
        return view('livewire.user-manager', [
            'users' => User::latest()->paginate(5)
        ])->layout('layouts.app');
    }

    public function adduser(){


        $this->validate();


        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        $this->resetInputFields();

        $this->message = 'User created successfully.';
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->user_id = null;
    }

    public function closeAlert()
    {
        $this->message = null;
    }


}

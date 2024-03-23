<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember_me=false;

    public function login(){
        $this->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email'=> $this->email,
            'password'=> $this->password,
        ], $this->remember_me)) {
            request()->session()->regenerate();
 
            return redirect('/');
        }else{
            $this->addError('login', 'Email or Password is incorrect');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}

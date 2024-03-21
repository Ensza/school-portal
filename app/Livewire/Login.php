<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public $remember_me=false;

    public function login(){
        $this->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'username'=> $this->username,
            'password'=> $this->password,
        ], $this->remember_me)) {
            request()->session()->regenerate();
 
            return redirect('/');
        }else{
            $this->addError('login', 'Username or Password is incorrect');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}

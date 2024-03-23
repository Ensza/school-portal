<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate]
    public $email;
    #[Validate]
    public $password;
    public $password_confirmation;
    public $birthday;
    public int $count = 0;

    public function rules(){
        return [
            'email'=>[
                'required',
                Rule::unique('users'),
                'email'
            ],
            'password'=>'required|confirmed|min:8',
            'birthday'=>[
                'required',
                'date'
            ]  
        ];
    }

    public function submit(){
        $this->validate();
    }

    public function render()
    {
        return view('livewire.register');
    }
}

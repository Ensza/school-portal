<?php

namespace App\Livewire;

use App\Mail\EmailVerification;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mail;

class Register extends Component
{
    #[Validate]
    public $email;
    #[Validate]
    public $password;
    public $password_confirmation;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $birthday;
    public $house_and_street;
    public $city_or_municipality;
    public $province;
    public $certify;

    #[Locked]
    public $email_verified = false;

    public $verifying_email = false;
    public $verification_code_input = '';

    public function rules(){
        return [
            'email'=>[
                'required',
                Rule::unique('users'),
                'email'
            ],
            'password'=>'required|confirmed|min:8',
            'first_name'=> 'required',
            'last_name'=>'required',
            'birthday'=>[
                'required',
                'date'
            ],
            'house_and_street'=>'required',
            'city_or_municipality'=>'required',
            'province'=> 'required',
        ];
    }

    public function mount(){
        if(session()->has('form_data')){
            session()->remove('form_data');
        }
    }

    public function submit(){
        $this->validate();


        $verification_code = '';
        // generate a verification code
        for($i= 0; $i < 6; $i++){
            $verification_code = $verification_code.rand(0,9);
        }

        session()->put('verification_code', $verification_code);
        
        Mail::to($this->email)->send(new EmailVerification($verification_code));
        
        // store form data to session then reset the properties of this component
        session()->put('form_data', $this->all());
        $this->reset();

        $this->verifying_email = true;
    }

    public function checkVerification(){
        if($this->verification_code_input != session()->get('verification_code')){
            $this->addError('verification', 'Wrong verification code');
            return;
        }

        $form_data = session()->get('form_data');

        $user = User::create([
            'email'=>$form_data['email'],
            'password'=>$form_data['password'],
            'role'=>'student'
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'classroom_id'=>0,
            'first_name'=>$form_data['first_name'],
            'middle_name'=>$form_data['middle_name'],
            'last_name'=>$form_data['last_name'],
            'birthday'=>$form_data['birthday'],
            'house_and_street'=> $form_data['house_and_street'],
            'city_or_municipality'=> $form_data['city_or_municipality'],
            'province'=> $form_data['province'],
        ]);

        session()->remove('form_data');


        $this->email_verified = true;
    }

    public function render()
    {
        return view('livewire.register');
    }
}

<?php

namespace App\Livewire\Admin\Faculties;

use App\Mail\FacultyPassword;
use App\Models\FacultyProfile;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mail;

class Register extends Component
{
    #[Validate]
    public $email;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $birthday;
    public $house_and_street;
    public $city_or_municipality;
    public $province;

    public $registration_success = false;


    public function rules(){
        return [
            'email'=>['required', Rule::unique('users'), 'email'],
            'first_name'=>'required',
            'last_name'=>'required',
            'birthday'=>'required|date',
            'house_and_street'=>'required',
            'city_or_municipality'=>'required',
            'province'=> 'required',
        ];
    }

    public function submit(){
        $this->validate();

        $password = '';

        for($i = 0; $i < 8; $i++){
            $password = $password.rand(0,9);
        }

        $user = User::create([
            'email'=>$this->email,
            'password'=>$password,
            'role'=>'faculty'
        ]);

        FacultyProfile::create([
            'user_id'=>$user->id,
            'classroom_id'=>0,
            'first_name'=>$this->first_name,
            'middle_name'=>$this->middle_name,
            'last_name'=>$this->last_name,
            'birthday'=>$this->birthday,
            'house_and_street'=>$this->house_and_street,
            'city_or_municipality'=>$this->city_or_municipality,
            'province'=>$this->province,
        ]);

        Mail::to($this->email)->send(new FacultyPassword($password));

        $this->reset();

        $this->registration_success = true;
    }

    public function render()
    {
        return view('livewire.admin.faculties.register');
    }
}

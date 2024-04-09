<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // method for checking if the user is an administrator
    public function isAdmin(){
        if($this->role == "administrator"){
            return true;
        }

        return false;
    }

    // method for checking if the user is a student
    public function isStudent(){
        if($this->role == "student"){
            return true;
        }

        return false;
    }

    // method for checking if the user is a faculty
    public function isFaculty(){
        if($this->role == "faculty"){
            return true;
        }

        return false;
    }

    public function profile(){
        if($this->isStudent()){
            return $this->hasOne(StudentProfile::class);
        }

        if($this->isFaculty()){
            return $this->hasOne(FacultyProfile::class);
        }
    }
}

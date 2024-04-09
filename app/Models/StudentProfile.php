<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'is_enrolled',
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'house_and_street',
        'city_or_municipality',
        'province',
    ];

    protected $casts = [
        'birthday'  => 'date',
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

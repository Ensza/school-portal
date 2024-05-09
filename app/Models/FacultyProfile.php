<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacultyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classroom_id',
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
    ];

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}

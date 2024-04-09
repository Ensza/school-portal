<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'strand_id',
        'level_id',
    ];

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function strand(){
        return $this->belongsTo(Strand::class);
    }

    public function subjects(){
        return $this->hasMany(ClassroomSubject::class);
    }

    public function students(){
        return $this->hasMany(StudentProfile::class);
    }

    use HasFactory;
}

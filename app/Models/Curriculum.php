<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'strand_id',
    ];

    public function strand(){
        return $this->belongsTo(Strand::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}

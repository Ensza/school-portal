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
        'curriculum_id',
    ];

    public function curriculum(){
        return $this->belongsTo(Curriculum::class);
    }

    public function strand(){
        return $this->belongsTo(Strand::class);
    }

    use HasFactory;
}

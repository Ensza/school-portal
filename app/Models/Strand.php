<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Track;

class Strand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'track_id'
    ];

    public function track(){
        return $this->belongsTo(Track::class);
    }
}

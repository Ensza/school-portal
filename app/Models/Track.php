<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Strand;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function strands()
    {
        return $this->hasMany(Strand::class);
    }
}

<?php

namespace App\Models;

use App\Models\Club;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['firstName', 'lastName', 'height', 'position', 'club_id', 'photoPlayer'];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}

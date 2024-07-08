<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['firstName', 'lastName', 'height', 'position', 'club_id','photoPlayer'];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}

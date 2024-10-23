<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasFactory;
    protected $fillable = ['nameClub'];

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $guarded = [];

    public function manager()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }
}

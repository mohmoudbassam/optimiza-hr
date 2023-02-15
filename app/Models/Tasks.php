<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

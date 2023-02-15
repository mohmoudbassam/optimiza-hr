<?php

namespace App\Models;


use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tasks()
    {

        return $this->hasMany(Tasks::class, 'bill_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'bill_id');
    }
}

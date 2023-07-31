<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainExpenses extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'main_expenses';

}

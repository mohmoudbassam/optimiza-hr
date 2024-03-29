<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bill(){
        return $this->belongsTo(Bill::class);
    }
    public function mainExpenses(){
        return $this->belongsTo(MainExpenses::class,'main_expenses_id','id');
    }
}

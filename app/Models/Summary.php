<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $guarded = [];

    protected $table= 'summary';

    public function Bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

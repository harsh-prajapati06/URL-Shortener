<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
    ];

    public function urls(){
        return $this->hasMany(Url::class,'company_id');
    }
}

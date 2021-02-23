<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $table = 'company';
    use HasFactory;

    public function employe(){
        return $this->hasMany(Employe::class);
    }

}

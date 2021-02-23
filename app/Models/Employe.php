<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    public $table = 'employe';
    use HasFactory;
    public function companyId(){
        return $this->belongsTo(Company::class);
    }
}

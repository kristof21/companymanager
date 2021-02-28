<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $table = 'company';
    protected $guarded = [];
    use HasFactory;

    public function employee(){
        return $this->hasMany(Employee::class);
    }

}

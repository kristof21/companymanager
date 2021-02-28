<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'employee';
    protected $guarded = [];
    use HasFactory;
    public function companyId(){
        return $this->belongsTo(Company::class);
    }
}

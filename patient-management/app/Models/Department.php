<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description'
    ];

    // Define the relationship with doctors
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}

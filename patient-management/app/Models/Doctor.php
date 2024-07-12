<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'contact_number', 
        'email', 
        'address', 
        'department_id', 
        'profile_image'
    ];

    // Define the relationship with department
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}

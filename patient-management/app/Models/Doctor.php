<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Appointment;
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

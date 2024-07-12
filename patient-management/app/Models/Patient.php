<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'gender', 'contact_number', 'email', 'address', 'profile_image'
    ];

    public function appointments()
{
    return $this->hasMany(Appointment::class);
}
}

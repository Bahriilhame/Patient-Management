<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // public function index()
    // {
    //     $appointments = Appointment::with('patient', 'doctor')->get();
    //     return view('appointments.index', compact('appointments'));
    // }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'contact_number' => 'required|string|max:20',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function index(Request $request)
    {
        // Search and Filter Logic
        $query = Appointment::query();

        if ($search = $request->get('search')) {
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $appointments = $query->with(['patient', 'doctor', 'doctor.department'])->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Affiche la liste des médecins
    public function index()
    {
        $doctors = Doctor::with('department')->get();
        return view('doctors.index', compact('doctors'));
    }

    // Affiche le formulaire pour créer un nouveau médecin
    public function create()
    {
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }

    // Enregistre un nouveau médecin dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:doctors,email',
            'address' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Handle the image upload
        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('profile_images', 'public');
        }

        Doctor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
            'profile_image' => $profileImage,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    // Affiche les détails d'un médecin
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    // Affiche le formulaire pour modifier un médecin
    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        return view('doctors.edit', compact('doctor', 'departments'));
    }

    // Met à jour les informations d'un médecin
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'address' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Handle the image upload
        $profileImage = $doctor->profile_image;
        if ($request->hasFile('profile_image')) {
            // Delete the old image if exists
            if ($profileImage && \Storage::exists('public/' . $profileImage)) {
                \Storage::delete('public/' . $profileImage);
            }

            // Store the new image
            $profileImage = $request->file('profile_image')->store('profile_images', 'public');
        }

        $doctor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
            'profile_image' => $profileImage,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    // Supprime un médecin de la base de données
    public function destroy(Doctor $doctor)
    {
        // Delete the profile image if exists
        if ($doctor->profile_image && \Storage::exists('public/' . $doctor->profile_image)) {
            \Storage::delete('public/' . $doctor->profile_image);
        }

        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}

@extends('layouts.app')

@section('content')
<div class="container">
    <div style=" display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;">
        <h1 style="margin: 0;">Doctors List</h1>
        <a href="{{ route('doctors.create') }}" class="btn btn-success">Add Doctor</a>
    </div>        <table class="table mt-3">
            <thead>
                <tr>
                    <th></th>
                    <th>Doctor</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                <tr>
                    <td>
                        <img src={{ $doctor->profile_image}} alt="Profile Image" style="width: 20px; height: auto;">
                        {{-- <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/default-profile.png') }}" alt="Profile Image" style="width: 20px; height: auto;"> --}}
                    </td>
                    <td>{{ "Dr. " . $doctor->first_name . " " . $doctor->last_name }}</td>
                    <td>{{ $doctor->contact_number }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->department ? $doctor->department->name : 'No Department' }}</td>
                    <td>
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

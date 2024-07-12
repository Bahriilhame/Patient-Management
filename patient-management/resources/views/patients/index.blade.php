@extends('layouts.app')

@section('content')
<div class="container">
    <div style=" display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;">
        <h1 style="margin: 0;">Patients List</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-success">Add Patient</a>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th></th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Date of birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
            <tr>
                {{-- <td>{{ $patient->id }}</td> --}}
                <td>
                    {{-- <img src={{  $patient->profile_image}} alt="Profile Image" style="width: 20px; height: auto;"> --}}
                    {{-- <a href="{{ $patient->profile_image }}"></a> --}}
                                        <img src="{{ $patient->profile_image ? asset('storage/' . $patient->profile_image) : asset('img/default-profile.png') }}" alt="Profile Image" style="width: 20px; height: auto;">

                </td>
                <td>{{ $patient->first_name }}</td>
                <td>{{ $patient->last_name }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->dob }}</td>
                <td>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline-block;">
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

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Appointments</h1>

    <!-- Search and Filter Form -->
    <div class="mb-3">
        <form action="{{ route('appointments.index') }}" method="GET" class="form-inline">
            <div class="form-group mb-2">
                <input type="text" class="form-control mr-2" name="search" placeholder="Search..." value="{{ request()->get('search') }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
        </form>
    </div>

    <!-- Appointments Table -->
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>MOB</th>
                <th>Date</th>
                <th>Doctor</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
            <tr>
                <td>
                    <img src="{{ $appointment->patient->profile_image ? asset('storage/' . $appointment->patient->profile_image) : asset('storage/default-avatar.png') }}" alt="Patient Photo" style="width: 50px; height: auto;">
                </td>
                <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                <td>{{ $appointment->contact_number }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>Dr. {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</td>
                <td>{{ $appointment->doctor->department->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-3">
        {{ $appointments->links() }}
    </div>
</div>
@endsection

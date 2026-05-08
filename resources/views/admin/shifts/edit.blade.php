@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0">Edit Shift - {{ $shift->user->name }}</h5>
        <a href="{{ route('admin.shifts.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="bg-light rounded p-4">
        <form method="POST" action="{{ route('admin.shifts.update', $shift->id) }}">
            @csrf
            @method('PATCH')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="user_id" class="form-label">User</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $shift->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="shift_date" class="form-label">Shift Date</label>
                    <input type="date" name="shift_date" id="shift_date" class="form-control" required value="{{ $shift->shift_date }}">
                </div>
                <div class="col-md-6">
                    <label for="user_rate" class="form-label">User Rate (per hour)</label>
                    <input type="number" step="0.01" name="user_rate" id="user_rate" class="form-control" required value="{{ $shift->user_rate }}">
                </div>
                <div class="col-md-6">
                    <label for="client_rate" class="form-label">Client Rate (per hour)</label>
                    <input type="number" step="0.01" name="client_rate" id="client_rate" class="form-control" required value="{{ $shift->client_rate }}">
                </div>
                <div class="col-md-6">
                    <label for="clock_in_datetime" class="form-label">Clock In Date & Time</label>
                    <input type="datetime-local" name="clock_in_datetime" id="clock_in_datetime" class="form-control" value="{{ $firstEntry ? $firstEntry->clock_in_datetime->format('Y-m-d\TH:i') : '' }}">
                </div>
                <div class="col-md-6">
                    <label for="clock_out_datetime" class="form-label">Clock Out Date & Time</label>
                    <input type="datetime-local" name="clock_out_datetime" id="clock_out_datetime" class="form-control" value="{{ $firstEntry ? $firstEntry->clock_out_datetime?->format('Y-m-d\TH:i') : '' }}">
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Shift</button>
            </div>
        </form>
    </div>
</div>
@endsection
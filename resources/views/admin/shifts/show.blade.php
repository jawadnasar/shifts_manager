<@php
    use Carbon\Carbon as Carbon;
@endphp
@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0">Shift Details - {{ $shift->user->name }}</h5>
        <a href="{{ route('admin.shifts.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="bg-light rounded p-4">
                <h6>Shift Info</h6>
                <p><strong>User:</strong> {{ $shift->user->name }}</p>
                <p><strong>Date:</strong> {{ $shift->shift_date }}</p>
                <p><strong>User Rate:</strong> ${{ $shift->user_rate }}/hr</p>
                <p><strong>Client Rate:</strong> ${{ $shift->client_rate }}/hr</p>
                <p><strong>Total Hours:</strong> {{ $shift->total_hours }}</p>
                <p><strong>Total Pay to User:</strong> ${{ $shift->total_pay_user }}</p>
                <p><strong>Total Billed to Client:</strong> ${{ $shift->total_billed_client }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-light rounded p-4">
                <h6>Clock Entries ({{ $shift->clockEntries->count() }})</h6>
                <ul class="list-group">
                    @foreach($shift->clockEntries as $entry)
                        <li class="list-group-item">
                            <strong>In:</strong> {{ $entry->clock_in_datetime->format('Y-m-d H:i:s') }}
                            @if($entry->clock_out_datetime)
                                <br><strong>Out:</strong> {{ $entry->clock_out_datetime->format('Y-m-d H:i:s') }}
                            @else
                                <span class="badge bg-warning">Ongoing</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
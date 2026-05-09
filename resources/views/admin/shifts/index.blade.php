@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0">Shifts Management</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clockInModal">
            <i class="fa fa-clock"></i> Clock In
        </button>
    </div>

    <div class="bg-light rounded p-4 mb-3">
        <form method="GET" action="{{ route('admin.shifts.index') }}">
            <div class="row g-3">
                <div class="col-md-2">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <label for="user_id" class="form-label">User</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ (string) request('user_id') === (string) $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="client_id_filter" class="form-label">Company</label>
                    <select name="client_id" id="client_id_filter" class="form-select">
                        <option value="">All Companies</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->accountid }}" {{ (string) request('client_id') === (string) $account->accountid ? 'selected' : '' }}>
                                {{ $account->company ?: $account->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.shifts.index') }}" class="btn btn-outline-secondary">Clear</a>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-light rounded p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Company</th>
                        <th>Shift Date</th>
                        <th>Total Hours</th>
                        <th>Number of Checkins</th>
                        <th>Payable Amount</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shifts as $shift)
                        <tr>
                            <td>{{ $loop->iteration + ($shifts->currentPage() - 1) * $shifts->perPage() }}</td>
                            <td>{{ $shift->user->name }}</td>
                            <td>{{ optional($shift->client)->company ?: optional($shift->client)->name ?: 'N/A' }}</td>
                            <td>{{ $shift->shift_date }}</td>
                            <td>{{ $shift->total_hours }}</td>
                            <td>{{ $shift->clockEntries->count() }}</td>
                            <td>£{{ number_format($shift->total_hours * ($shift->user_rate ?? 0), 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $shift->id }}" aria-expanded="false" aria-controls="details-{{ $shift->id }}">
                                    Show Details
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('admin.shifts.show', $shift->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                <a href="{{ route('admin.shifts.edit', $shift->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                @if($shift->clockEntries->whereNull('clock_out_datetime')->count() > 0)
                                    <form method="POST" action="{{ route('admin.shifts.clockOut', $shift->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success">Clock Out</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="p-0">
                                <div class="collapse" id="details-{{ $shift->id }}">
                                    <div class="card card-body">
                                        <h6>Checkins and Checkouts</h6>
                                        @if($shift->clockEntries->count() > 0)
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Clock In</th>
                                                        <th>Clock Out</th>
                                                        <th>Hours</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($shift->clockEntries as $entry)
                                                        <tr>
                                                            <td>{{ $entry->clock_in_datetime ? $entry->clock_in_datetime->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                                            <td>{{ $entry->clock_out_datetime ? $entry->clock_out_datetime->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                                            <td>
                                                                @if($entry->clock_in_datetime && $entry->clock_out_datetime)
                                                                    {{ number_format($entry->clock_in_datetime->diffInMinutes($entry->clock_out_datetime) / 60, 2) }} hours
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No checkins recorded.</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $shifts->links() }}
    </div>
</div>

<!-- Clock In Modal -->
<div class="modal fade" id="clockInModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.shifts.clockIn') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Clock In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="clock_in_datetime" class="form-label">Clock In Date & Time</label>
                        <input type="datetime-local" name="clock_in_datetime" id="clock_in_datetime" class="form-control" required value="{{ old('clock_in_datetime', now()->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div class="mb-3">
                        <label for="clock_out_datetime" class="form-label">Clock Out Date & Time (optional)</label>
                        <input type="datetime-local" name="clock_out_datetime" id="clock_out_datetime" class="form-control" value="{{ old('clock_out_datetime') }}">
                    </div>
                    <div class="mb-3">
                        <label for="user_rate" class="form-label">User Rate (per hour)</label>
                        <input type="number" step="0.01" name="user_rate" id="user_rate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Company (Account)</label>
                        <select name="client_id" id="client_id" class="form-select">
                            <option value="">Select Company</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->accountid }}">
                                    {{ $account->company ?: $account->name }} ({{ $account->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="client_rate" class="form-label">Client Rate (per hour)</label>
                        <input type="number" step="0.01" name="client_rate" id="client_rate" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Clock In</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const clockInInput = document.getElementById('clock_in_datetime');
        const clockOutInput = document.getElementById('clock_out_datetime');

        function validateClockOut() {

            if (!clockInInput.value) {
                return;
            }

            // Clock out cannot be before clock in
            clockOutInput.min = clockInInput.value;

            // If already selected invalid datetime
            if (
                clockOutInput.value &&
                clockOutInput.value < clockInInput.value
            ) {
                alert('Clock Out date/time must be greater than or equal to Clock In date/time.');

                clockOutInput.value = '';
            }
        }

        clockInInput.addEventListener('change', validateClockOut);
        clockOutInput.addEventListener('change', validateClockOut);

    });
</script>
@endsection
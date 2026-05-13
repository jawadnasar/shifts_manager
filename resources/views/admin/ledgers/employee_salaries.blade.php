@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Employee salaries (shift pay)</h5>
        </div>

        <div class="bg-light rounded p-4 mb-3">
            <form method="GET" action="{{ route('admin.ledgers.employee_salaries') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date from</label>
                        <input type="date" name="date_from" id="date_from" class="form-control"
                            value="{{ request('date_from', $dateFrom) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date to</label>
                        <input type="date" name="date_to" id="date_to" class="form-control"
                            value="{{ request('date_to', $dateTo) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Employee</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">All employees</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ (string) request('user_id') === (string) $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary">Apply</button>
                        <a href="{{ route('admin.ledgers.employee_salaries') }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-light rounded p-4 mb-3">
            <p class="mb-1 text-muted small">Totals for the selected period{{ request('user_id') ? ' and employee' : '' }}.</p>
            <p class="mb-0 fs-5 fw-semibold">
                Grand total: {{ number_format((float) $grandTotal, 2) }}
            </p>
        </div>

        <div class="bg-light rounded p-4 mb-3">
            <h6 class="mb-3">By employee</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Employee</th>
                            <th class="text-end">Shift postings</th>
                            <th class="text-end">Total pay</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perEmployee as $row)
                            <tr>
                                <td>{{ $row->employee_name }}</td>
                                <td class="text-end">{{ (int) $row->shift_count }}</td>
                                <td class="text-end fw-semibold">{{ number_format((float) $row->total_pay, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No salary postings in this range.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-light rounded p-4">
            <h6 class="mb-3">Ledger lines</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Shift ID</th>
                            <th>VType</th>
                            <th>Details</th>
                            <th class="text-end">Pay (debit)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lines as $line)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($line->date)->format('d/m/Y') }}</td>
                                <td>{{ $line->user?->name ?? '—' }}</td>
                                <td>{{ $line->transid }}</td>
                                <td><span class="badge bg-secondary">{{ $line->vtype }}</span></td>
                                <td>{{ $line->details }}</td>
                                <td class="text-end">{{ number_format((float) $line->debit, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No lines in this range.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $lines->links() }}
            </div>
        </div>
    </div>
@endsection

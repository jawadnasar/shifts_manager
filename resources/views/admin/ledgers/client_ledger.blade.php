@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0">Client Ledger</h5>
    </div>

    <!-- Filter Form -->
    <div class="bg-light rounded p-4 mb-3">
        <form method="GET" action="{{ route('admin.ledgers.client_ledger') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from', $dateFrom) }}">
                </div>
                <div class="col-md-3">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to', $dateTo) }}">
                </div>
                <div class="col-md-2">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-select">
                        <option value="">All Clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->accountid }}" {{ request('client_id') == $client->accountid ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.ledgers.client_ledger') }}" class="btn btn-outline-secondary">Clear</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Summary Section -->
    @if(count($clientSummary) > 0)
    <div class="bg-light rounded p-4 mb-3">
        <h6 class="mb-3">Summary by Client</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Shifts Count</th>
                        <th>Total Billed</th>
                        <th>Tax (20%)</th>
                        <th>Total with Tax</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientSummary as $summary)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $summary->client->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $summary->shift_count }}</td>
                            <td class="text-end">{{ number_format((float) $summary->total_billed, 2) }}</td>
                            <td class="text-end">{{ number_format((float) $summary->tax_amount, 2) }}</td>
                            <td class="text-end fw-bold">{{ number_format((float) $summary->total_with_tax, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-primary fw-bold">
                        <td colspan="2">TOTAL</td>
                        <td colspan="1"></td>
                        <td class="text-end">{{ number_format((float) $grandTotalBilled, 2) }}</td>
                        <td class="text-end">{{ number_format((float) $grandTotalTax, 2) }}</td>
                        <td class="text-end">{{ number_format((float) $grandTotalWithTax, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Detailed Shifts Table -->
    <div class="bg-light rounded p-4">
        <h6 class="mb-3">Detailed Shifts</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Employee</th>
                        <th>Hours</th>
                        <th>Client Rate</th>
                        <th>Amount Billed</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shifts as $shift)
                        <tr>
                            <td>{{ $loop->iteration + ($shifts->currentPage() - 1) * $shifts->perPage() }}</td>
                            <td>{{ $shift->shift_date }}</td>
                            <td>{{ $shift->client->name ?? 'N/A' }}</td>
                            <td>{{ $shift->user->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ number_format((float) $shift->total_hours, 2) }}</td>
                            <td class="text-end">{{ number_format((float) $shift->client_rate, 2) }}</td>
                            <td class="text-end">{{ number_format((float) $shift->total_billed_client, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No shift records found for the selected period.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $shifts->links() }}
        </div>
    </div>
</div>
@endsection

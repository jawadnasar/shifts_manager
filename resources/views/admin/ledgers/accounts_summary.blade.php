@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0">Ledger</h5>
    </div>

    <div class="bg-light rounded p-4 mb-3">
        <form method="GET" action="{{ route('admin.ledgers.ledger') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from', $dateFrom) }}">
                </div>
                <div class="col-md-3">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to', $dateTo) }}">
                </div>
                <div class="col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.ledgers.ledger') }}" class="btn btn-outline-secondary">Clear</a>
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
                        <th>Account Name</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Starting Balance</th>
                        <th>End Balance</th>
                        <th>Actual Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ledgers as $ledger)
                        <tr>
                            <td>{{ $loop->iteration + ($ledgers->currentPage() - 1) * $ledgers->perPage() }}</td>
                            <td>{{ $ledger->company ?: $ledger->name }}</td>
                            <td>{{ $dateFrom }}</td>
                            <td>{{ $dateTo }}</td>
                            <td>{{ number_format((float) $ledger->starting_balance, 2) }}</td>
                            <td>{{ number_format((float) $ledger->end_balance, 2) }}</td>
                            <td>{{ number_format((float) $ledger->actual_balance, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No ledger records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $ledgers->links() }}
        </div>
    </div>
</div>
@endsection

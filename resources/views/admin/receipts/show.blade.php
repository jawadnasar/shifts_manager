@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Receipt #{{ $receipt->transid }}</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.receipts.index') }}" class="btn btn-outline-secondary">Back</a>
                @if (Auth::user()->pri_editreceipt && $receipt->canEdit())
                    <a href="{{ route('admin.receipts.edit', $receipt) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="bg-light rounded p-4" style="max-width: 40rem;">
            <dl class="row mb-0">
                <dt class="col-sm-4">Date</dt>
                <dd class="col-sm-8">{{ $receipt->date->format('Y-m-d') }}</dd>
                <dt class="col-sm-4">Debit</dt>
                <dd class="col-sm-8">{{ $receipt->debitAccount?->name ?? $receipt->debitac }}</dd>
                <dt class="col-sm-4">Credit</dt>
                <dd class="col-sm-8">{{ $receipt->creditAccount?->name ?? $receipt->creditac }}</dd>
                <dt class="col-sm-4">Amount</dt>
                <dd class="col-sm-8">{{ number_format((float) $receipt->amount, 2) }}</dd>
                <dt class="col-sm-4">User</dt>
                <dd class="col-sm-8">{{ $receipt->user?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Details</dt>
                <dd class="col-sm-8">{{ $receipt->details }}</dd>
                <dt class="col-sm-4">Created by</dt>
                <dd class="col-sm-8">{{ $receipt->createdByUser?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Updated by</dt>
                <dd class="col-sm-8">{{ $receipt->updatedByUser?->name ?? '—' }}</dd>
            </dl>
        </div>
    </div>
@endsection

@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Payment #{{ $payment->transid }}</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">Back</a>
                @if (Auth::user()->pri_editpayment && $payment->canEdit())
                    <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="bg-light rounded p-4" style="max-width: 40rem;">
            <dl class="row mb-0">
                <dt class="col-sm-4">Date</dt>
                <dd class="col-sm-8">{{ $payment->date->format('Y-m-d') }}</dd>
                <dt class="col-sm-4">Debit</dt>
                <dd class="col-sm-8">{{ $payment->debitAccount?->name ?? $payment->debitac }}</dd>
                <dt class="col-sm-4">Credit</dt>
                <dd class="col-sm-8">{{ $payment->creditAccount?->name ?? $payment->creditac }}</dd>
                <dt class="col-sm-4">Amount</dt>
                <dd class="col-sm-8">{{ number_format((float) $payment->amount, 2) }}</dd>
                <dt class="col-sm-4">User</dt>
                <dd class="col-sm-8">{{ $payment->user?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Cheque</dt>
                <dd class="col-sm-8">{{ $payment->cheque_no ?? '—' }}</dd>
                <dt class="col-sm-4">Cheque date</dt>
                <dd class="col-sm-8">{{ $payment->cheque_date?->format('Y-m-d') ?? '—' }}</dd>
                <dt class="col-sm-4">Details</dt>
                <dd class="col-sm-8">{{ $payment->details }}</dd>
                <dt class="col-sm-4">Created by</dt>
                <dd class="col-sm-8">{{ $payment->createdByUser?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Updated by</dt>
                <dd class="col-sm-8">{{ $payment->updatedByUser?->name ?? '—' }}</dd>
            </dl>
        </div>
    </div>
@endsection

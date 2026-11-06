@extends('layouts.app')

@section('title', $customer->name)

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">{{ $customer->name }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Back</a>
            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <dl class="row mb-0 details">
                <dt class="col-4 col-md-2">Email</dt>
                <dd class="col-8 col-md-10 text-break">{{ $customer->email }}</dd>

                <dt class="col-4 col-md-2">Phone</dt>
                <dd class="col-8 col-md-10 mb-0">{{ $customer->phone }}</dd>
            </dl>
        </div>
    </div>

    <h2 class="h5">Orders ({{ $customer->orders->count() }})</h2>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order Number</th>
                            <th class="text-end">Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customer->orders as $order)
                            <tr>
                                <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                                <td class="text-end">${{ number_format($order->total_amount, 2) }}</td>
                                <td>@include('Orders._status-badge', ['status' => $order->status])</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">This customer has no orders.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

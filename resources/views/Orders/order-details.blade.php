@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Order {{ $order->order_number }}</h1>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Back to Orders</a>
            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('orders.delete', $order->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete order {{ $order->order_number }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="row g-3">

        <!-- Order info -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">Order Information</div>
                <div class="card-body">
                    <dl class="row mb-0 details">
                        <dt class="col-5">Order Number</dt>
                        <dd class="col-7">{{ $order->order_number }}</dd>

                        <dt class="col-5">Total Amount</dt>
                        <dd class="col-7">${{ number_format($order->total_amount, 2) }}</dd>

                        <dt class="col-5">Status</dt>
                        <dd class="col-7">@include('Orders._status-badge', ['status' => $order->status])</dd>

                        <dt class="col-5">Created</dt>
                        <dd class="col-7">{{ $order->created_at->format('Y-m-d H:i') }}</dd>

                        <dt class="col-5">Last Updated</dt>
                        <dd class="col-7 mb-0">{{ $order->updated_at->format('Y-m-d H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Customer info -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">Customer</div>
                <div class="card-body">
                    <dl class="row mb-0 details">
                        <dt class="col-5">Name</dt>
                        <dd class="col-7">{{ $order->customer?->name ?? '-' }}</dd>

                        <dt class="col-5">Email</dt>
                        <dd class="col-7 text-break">{{ $order->customer?->email ?? '-' }}</dd>

                        <dt class="col-5">Phone</dt>
                        <dd class="col-7 mb-0">{{ $order->customer?->phone ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Change status -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">Change Status</div>
                <div class="card-body">
                    <form action="{{ route('orders.status', $order->id) }}" method="POST"
                          class="row g-2 align-items-center">
                        @csrf
                        @method('PATCH')

                        <div class="col-12 col-sm-8 col-md-4">
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-4 col-md-auto">
                            <button type="submit" class="btn btn-primary w-100">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@extends('layouts.app')

@section('title', 'Orders')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Orders</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">+ New Order</a>
    </div>

    <!-- Search & Filter (GET, so the values stay in the URL) -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form action="{{ route('orders.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-12 col-md-5">
                    <label for="search" class="form-label">Order number</label>
                    <input type="text" id="search" name="search" class="form-control"
                           value="{{ $search }}" placeholder="Search by order number">
                </div>

                <div class="col-12 col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">All statuses</option>
                        @foreach ($statuses as $item)
                            <option value="{{ $item }}" @selected($status === $item)>{{ ucfirst($item) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark flex-fill">Filter</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th class="text-end">Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->order_number }}</td>
                                <td>{{ $order->customer?->name ?? '-' }}</td>
                                <td class="text-end">${{ number_format($order->total_amount, 2) }}</td>
                                <td>@include('Orders._status-badge', ['status' => $order->status])</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="text-end">
                                    <a class="btn btn-info btn-sm text-white"
                                       href="{{ route('orders.show', $order->id) }}">View</a>

                                    <a class="btn btn-warning btn-sm"
                                       href="{{ route('orders.edit', $order->id) }}">Edit</a>

                                    <form action="{{ route('orders.delete', $order->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete order {{ $order->order_number }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination (10 per page; keeps search/status in the links) -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
        <small class="text-muted">
            Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} orders
        </small>
        {{ $orders->links() }}
    </div>

@endsection

@extends('layouts.app')

@section('title', 'Customers')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Customers</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">+ New Customer</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td class="text-end">
                                    <a class="btn btn-info btn-sm text-white"
                                       href="{{ route('customers.show', $customer->id) }}">View</a>

                                    <a class="btn btn-warning btn-sm"
                                       href="{{ route('customers.edit', $customer->id) }}">Edit</a>

                                    <form action="{{ route('customers.delete', $customer->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete {{ $customer->name }} and all their orders?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No customers yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

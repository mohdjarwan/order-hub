@extends('layouts.app')

@section('title', 'New Customer')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h5 mb-0">Create New Customer</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST" novalidate>
                        @csrf

                        @include('Customers._form', ['customer' => null])

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-success">Create Customer</button>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

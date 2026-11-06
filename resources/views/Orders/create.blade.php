@extends('layouts.app')

@section('title', 'New Order')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h5 mb-0">Create New Order</h1>
                </div>

                <div class="card-body">

                    @if ($customers->isEmpty())
                        <div class="alert alert-warning">
                            There are no customers yet.
                            <a href="{{ route('customers.create') }}">Create a customer</a> first.
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" novalidate>
                        @csrf

                        @include('Orders._form', ['order' => null])

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-success">Create Order</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

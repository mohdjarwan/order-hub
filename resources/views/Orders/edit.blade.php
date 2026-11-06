@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h5 mb-0">Edit Order {{ $order->order_number }}</h1>
                </div>

                <div class="card-body">

                    <form action="{{ route('orders.update', $order->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        @include('Orders._form', ['order' => $order])

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

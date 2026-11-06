<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Hub - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table td, .table th { white-space: nowrap; }
        .details dt { color: #6c757d; font-weight: 500; }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar: collapses into a menu button on small screens -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('orders.index') }}">Order Hub</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link {{ request()->routeIs('orders.index', 'orders.show', 'orders.edit') ? 'active' : '' }}"
                       href="{{ route('orders.index') }}">Orders</a>
                    <a class="nav-link {{ request()->routeIs('orders.create') ? 'active' : '' }}"
                       href="{{ route('orders.create') }}">New Order</a>
                    <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}"
                       href="{{ route('customers.index') }}">Customers</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

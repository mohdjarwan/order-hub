<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $orders = Order::with('customer')
            ->when($search, function ($query, $search) {
                $query->where('order_number', 'like', '%' . $search . '%');
            })
            ->when(in_array($status, Order::STATUSES, true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('Orders.orders', [
            'orders' => $orders,
            'statuses' => Order::STATUSES,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function show($id)
    {
        $order = Order::with('customer')->findOrFail($id);

        return view('Orders.order-details', [
            'order' => $order,
            'statuses' => Order::STATUSES,
        ]);
    }

    public function create()
    {
        return view('Orders.create', [
            'customers' => Customer::orderBy('name')->get(),
            'statuses' => Order::STATUSES,
        ]);
    }

    public function store(OrderRequest $request)
    {
        Order::create($request->validated());

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('Orders.edit', [
            'order' => $order,
            'customers' => Customer::orderBy('name')->get(),
            'statuses' => Order::STATUSES,
        ]);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->validated());

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(Order::STATUSES)],
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order status changed to ' . ucfirst($order->status) . '.');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}

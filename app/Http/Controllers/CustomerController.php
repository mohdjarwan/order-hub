<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('Customers.customers', [
            'customers' => $customers
        ]);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }

        return view('Customers.customer-details', [
            'customer' => $customer
        ]);
    }

    public function create()
    {
        return view('Customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:customers,email',
            'Phone' => 'required|string|max:20'
        ]);

        $customer = new Customer();
        $customer->name = $request->Name;
        $customer->email = $request->Email;
        $customer->phone = $request->Phone;
        $customer->save();

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }

        return view('Customers.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }

        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:customers,email,' . $customer->id,
            'Phone' => 'required|string|max:20'
        ]);

        $customer->name = $request->Name;
        $customer->email = $request->Email;
        $customer->phone = $request->Phone;
        $customer->save();

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }


    public function delete($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}

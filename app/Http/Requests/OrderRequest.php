<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // On update the route has an {id}; on create it is null.
        $orderId = $this->route('id');

        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'order_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('orders', 'order_number')->ignore($orderId),
            ],
            'total_amount' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'status' => ['required', Rule::in(Order::STATUSES)],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'order_number.unique' => 'This order number is already used.',
            'total_amount.gt' => 'The total amount must be greater than zero.',
            'status.in' => 'The selected status is not valid.',
        ];
    }
}

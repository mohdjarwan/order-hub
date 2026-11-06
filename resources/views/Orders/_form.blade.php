{{-- Shared fields for the Create and Edit forms. $order is null on Create. --}}

<div class="row g-3">

    <!-- Customer -->
    <div class="col-12 col-md-6">
        <label for="customer_id" class="form-label">Customer</label>
        <select id="customer_id" name="customer_id"
                class="form-select @error('customer_id') is-invalid @enderror">
            <option value="">Select a customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}"
                    @selected(old('customer_id', $order?->customer_id) == $customer->id)>
                    {{ $customer->name }} ({{ $customer->email }})
                </option>
            @endforeach
        </select>
        @error('customer_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Order Number -->
    <div class="col-12 col-md-6">
        <label for="order_number" class="form-label">Order Number</label>
        <input type="text" id="order_number" name="order_number"
               class="form-control @error('order_number') is-invalid @enderror"
               value="{{ old('order_number', $order?->order_number) }}"
               placeholder="e.g. ORD-1001">
        @error('order_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Total Amount -->
    <div class="col-12 col-md-6">
        <label for="total_amount" class="form-label">Total Amount</label>
        <div class="input-group has-validation">
            <span class="input-group-text">$</span>
            <input type="number" id="total_amount" name="total_amount" step="0.01"
                   class="form-control @error('total_amount') is-invalid @enderror"
                   value="{{ old('total_amount', $order?->total_amount) }}"
                   placeholder="0.00">
            @error('total_amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Status -->
    <div class="col-12 col-md-6">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status"
                class="form-select @error('status') is-invalid @enderror">
            @foreach ($statuses as $status)
                <option value="{{ $status }}"
                    @selected(old('status', $order?->status ?? 'pending') === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

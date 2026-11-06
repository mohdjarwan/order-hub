{{-- Shared fields for the Create and Edit customer forms. $customer is null on Create. --}}

<div class="row g-3">
    <div class="col-12">
        <label for="Name" class="form-label">Name</label>
        <input type="text" id="Name" name="Name"
               class="form-control @error('Name') is-invalid @enderror"
               value="{{ old('Name', $customer?->name) }}" placeholder="Customer name">
        @error('Name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="Email" class="form-label">Email</label>
        <input type="email" id="Email" name="Email"
               class="form-control @error('Email') is-invalid @enderror"
               value="{{ old('Email', $customer?->email) }}" placeholder="name@example.com">
        @error('Email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="Phone" class="form-label">Phone</label>
        <input type="text" id="Phone" name="Phone"
               class="form-control @error('Phone') is-invalid @enderror"
               value="{{ old('Phone', $customer?->phone) }}" placeholder="07XXXXXXXX">
        @error('Phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

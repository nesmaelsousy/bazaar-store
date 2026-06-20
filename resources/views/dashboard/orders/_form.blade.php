@push('css')
    <style>
        .page-icon {
            padding: 8px 14px;
            border-radius: 8px;
            background-color: #f3e6dc;
            border: 1px solid #A0522D;
            color: #A0522D;
            font-size: 1.1rem;
        }

        .page-title {
            color: #A0522D;
            font-size: 1.4rem;
            font-weight: 700;
            margin-left: 5px;
        }

        .page-subtitle {
            color: #9e7b6b;
            font-size: 0.88rem;
            margin-top: 2px;
        }

        .form-divider {
            border: none;
            border-top: 1px solid #f0e6de;
            margin: 1.5rem 0;
        }

        .section-title {
            font-size: 0.72rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #c49a80;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0e6de;
        }

        .section-block {
            margin-bottom: 2rem;
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #7a5c4e;
            margin-bottom: 5px;
        }


        /* .required-star {
                                    color: #d9534f;
                                    font-size: 0.7rem;
                                } */
        .show-img {
            height: 200px;
            width: 200px;
            border: 2px dashed #ccc;
            overflow: hidden;

        }

        .form-control {
            padding: 20px;
        }

        .form-control,
        .form-control {
            background-color: #fdf7f4;
            border: 1px solid #e2cdc2;
            border-radius: 8px;
            font-size: 0.87rem;
            color: #4a3328;
            padding: 0.55rem 0.85rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus,
        .form-control:focus {
            border-color: #A0522D;
            box-shadow: 0 0 0 3px rgba(160, 82, 45, 0.12);
            background-color: #fff;
            outline: none;
        }

        .form-control::placeholder {
            color: #b89080;
        }

        .field-hint {
            font-size: 0.72rem;
            color: #b89080;
            margin-top: 4px;
        }

        .id-field {
            background-color: #f9f1ec;
            border: 1px dashed #e2cdc2;
            border-radius: 8px;
            padding: 0.55rem 0.85rem;
            font-size: 0.82rem;
            color: #c4a898;
            font-family: monospace;
        }

        /* Toggle buttons */
        .toggle-group {
            display: flex;
            gap: 8px;
        }

        .toggle-btn {
            flex: 1;
            padding: 0.5rem;
            border-radius: 8px;
            border: 1px solid #e2cdc2;
            background: #fdf7f4;
            color: #9e7b6b;
            font-size: 0.83rem;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            transition: all 0.15s;
            order-select: none;
        }

        .toggle-btn.active-green {
            background: #eaf7f0;
            border-color: #3ecf8e;
            color: #1f9e65;
        }

        .toggle-btn.active-danger {
            background: #fff8ec;
            border-color: #f00505;
            color: #b91a1a;
        }

        .toggle-btn.active-brown {
            background: #f3e6dc;
            border-color: #A0522D;
            color: #A0522D;
        }

        /* Image upload */
        .img-upload-row {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .img-preview {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #f3e6dc;
            border: 2px dashed #e2cdc2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            overflow: hidden;
            color: #c4a898;
        }

        .img-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        /* Timestamps */
        .ts-chip {
            background: #f9f1ec;
            border: 1px dashed #e2cdc2;
            border-radius: 8px;
            padding: 0.5rem 0.85rem;
            font-size: 0.78rem;
            color: #b89080;
            font-family: monospace;
        }

        .ts-chip .ts-label {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.7rem;
            font-weight: 600;
            color: #c4a898;
            display: block;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Actions */
        .btn-save {
            background-color: #A0522D;
            color: #fff;
            border: none;
            padding: 0.55rem 1.75rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s ease, transform 0.15s ease;
            cursor: pointer;
        }

        .btn-save:hover {
            background-color: #8B4513;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background-color: #f3e6dc;
            color: #A0522D;
            border: 1px solid #A0522D;
            padding: 0.55rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .btn-cancel:hover {
            background-color: #e8d5c8;
            color: #8B4513;
        }
    </style>
@endpush
{{-- Profile Image --}}
<div class="section-block">
    {{-- الحقول --}}
    <div class="section-block">
        <div class="section-title">Order Information</div>

        <div class="row g-3">
            <div class="col-md-6">
                <x-form.select label="Customer" name="user_id" :options="$users" firstOne="Select Customer"
                    :oldVal="old('user_id', $order->user_id ?? '')" />
            </div>

            <div class="col-md-6">
                <x-form.select label="Seller" name="seller_id" :options="$sellers" firstOne="Select Seller"
                    :oldVal="old('seller_id', $order->seller_id ?? '')" />
            </div>
              

            <div class="col-md-6 mt-2">
                <x-form.input label="Total Price" name="total_price" type="number" step="0.01" :oldVal="old('total_price', $order->total_price ?? '')" placeholder="e.g. 50$" />
            </div>

            <div class="col-md-6 mt-2">
                <label class="form-label">Order Type</label>

                <select name="order_type" class="form-control">
                    <option value="normal" {{ ($order->order_type ?? '') == 'normal' ? 'selected' : '' }}>
                        Normal
                    </option>

                    <option value="custom" {{ ($order->order_type ?? '') == 'custom' ? 'selected' : '' }}>
                        Custom
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Payment Method</label>

                <select name="payment_method" class="form-control">
                    <option value="stripe" {{ ($order->payment_method ?? '') == 'stripe' ? 'selected' : '' }}>
                        Stripe
                    </option>
                    <option value="cash" {{ ($order->payment_method ?? '') == 'cash' ? 'selected' : '' }}>
                        Cash
                    </option>
                </select>
            </div>

        </div>


    </div>

    <div class="section-block">
        <div class="section-title">Order Status</div>


        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Order Status</label>

                <select name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="delivering">Delivering</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="refuned">Refunded</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Payment Status</label>

                <select name="payment_status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                </select>
            </div>

        </div>


    </div>


    {{-- Actions --}}
    <hr class="form-divider">

    <div class="d-flex align-items-center gap-2 mt-3">
        <button type="submit" class="btn-save">
            <i class="fas fa-save me-1"></i> Save
        </button>

        <a href="{{ route('admin.order.index') }}" class="btn-cancel ml-3">
            Cancel
        </a>
    </div>


</div>
</div>

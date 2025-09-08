@extends('layouts.admin.app')

@section('main-container')
<div class="pc-container">
    <div class="pc-content">

        {{-- Order Product Details --}}
        <div class="card mx-auto mt-5 shadow-sm border rounded" style="max-width: 900px;">
            <div class="card-body">

                @forelse ($orderdetails as $item)
                    @php
                        $product = $products->where('id', $item->product_id)->first();
                    @endphp

                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                        {{-- Left: Image --}}
                        <div class="d-flex align-items-center">
                            @if ($product && $product->firstVariantImage)
                                <img src="{{ asset('variantThumbnail/' . $product->firstVariantImage->name) }}"
                                    alt="Product Image"
                                    class="rounded me-3"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex justify-content-center align-items-center rounded me-3"
                                     style="width: 70px; height: 70px;">
                                    <span class="text-muted small">No Image</span>
                                </div>
                            @endif

                            {{-- Product Details --}}
                            <div>
                                <h6 class="mb-1 fw-semibold">{{ $product->name ?? 'N/A' }}</h6>
                                <span class="badge bg-light text-dark mb-1">
                                    {{ $product->firstVariant->name ?? 'Default' }}
                                </span>
                                <p class="text-muted small mb-0">
                                    SKU: {{ $product->sku ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        {{-- Right: Pricing --}}
                        <div class="text-end">
                            @if ($item->original_price && $item->original_price > $item->price)
                                <small class="text-muted text-decoration-line-through me-2">
                                    ₹{{ number_format($item->original_price, 2) }}
                                </small>
                            @endif
                            <span class="fw-semibold">₹{{ number_format($item->price, 2) }}</span>
                            <div class="text-muted small">× {{ $item->quantity }}</div>
                            <div class="fw-bold">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted my-4">No products found in this order.</p>
                @endforelse

            </div>
        </div>

        {{-- Payment Summary --}}
        <div class="card mx-auto mt-4 shadow-sm border rounded" style="max-width: 900px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Subtotal ({{ $orderdetails->count() }} items)</span>
                    <span>₹{{ number_format($orderdetails->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Shipping Charges</span>
                    <span>₹0</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center fw-bold">
                    <span>Total</span>
                    <span>₹{{ number_format($orderdetails->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                </div>
                <div class="mt-2">
                    <span class="badge bg-success">Paid</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

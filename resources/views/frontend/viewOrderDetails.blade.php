@extends('layouts.frontend.productpage.indexProductdetail')

@section('main-container')
    <style>
        .custom-bg {
            background: linear-gradient(to right, #e2e8f0, #e5e7eb);
        }

        .custom-btn:hover {
            background-color: #f3e8ff !important;
            transition: background-color 0.3s ease-in-out;
        }

        .product-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .order-summary-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (prefers-color-scheme: dark) {
            .custom-bg {
                background: linear-gradient(to right, #1f2937, #111827);
                color: white !important;
            }

            .custom-btn {
                background-color: #374151 !important;
                color: white !important;
            }

            .custom-btn:hover {
                background-color: #4b5563 !important;
            }

            .product-card {
                background-color: rgba(55, 65, 81, 0.9);
                color: white;
            }

            .order-summary-card {
                background-color: rgba(55, 65, 81, 0.95);
                color: white;
            }
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-paid {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-delivered {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-cancelled {
            background-color: #fecaca;
            color: #991b1b;
        }
    </style>
    {{-- {{ dd($orderdetails); }} --}}
    <div class="custom-bg text-dark py-5">
        <div class="container">
            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="display-6 fw-bold text-white mb-0">Order Details</h1>
                <a href="{{ route('view.order') }}" class="btn btn-outline-light custom-btn">
                    <i class="ri-arrow-left-line me-1"></i> Back to Orders
                </a>
            </div>

            <div class="row">
                <!-- Order Summary Card -->
                <div class="col-lg-4 mb-4">
                    <div class="order-summary-card p-4">
                        <h4 class="fw-bold mb-3">Order Summary</h4>

                        <div class="mb-3">
                            <small class="text-muted">Order ID</small>
                            <div class="fw-bold">#{{ $orderdetails->first()->order_id ?? 'N/A' }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Order Date</small>
                            <div>
                                {{ $orderdetails->first()->created_at ? $orderdetails->first()->created_at->format('d M Y, h:i A') : 'N/A' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Payment Status</small>
                            <div>
                                @if (isset($order->payment_status))
                                    @if ($order->payment_status == 'Paid')
                                        <span class="status-badge status-paid">Paid</span>
                                    @else
                                        <span class="status-badge status-pending">Pending</span>
                                    @endif
                                @else
                                    <span class="status-badge status-pending">Unknown</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Delivery Status</small>
                            <div>
                                @if (isset($orderdetails->first()->order->delivery_status))
                                    @php
                                        $status = strtolower($order->delivery_status);
                                    @endphp
                                    @if ($status == 'delivered')
                                        <span class="status-badge status-delivered">Delivered</span>
                                    @elseif($status == 'processing')
                                        <span class="status-badge status-processing">Processing</span>
                                    @elseif($status == 'cancelled')
                                        <span class="status-badge status-cancelled">Cancelled</span>
                                    @else
                                        <span class="status-badge status-processing">{{ ucfirst($status) }}</span>
                                    @endif
                                @else
                                    <span class="status-badge status-processing">Processing</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Payment Method</small>
                            <div>{{ $order->payment_method ?? 'N/A' }}</div>
                        </div>

                        <hr>

                        <div class="mb-2">
                            <small class="text-muted">Total Items</small>
                            <div class="fw-bold">{{ $orderdetails->count() }} items</div>
                        </div>

                        <div>
                            <small class="text-muted">Total Amount</small>
                            <div class="fw-bold fs-5">₹{{ $order->total ?? $orderdetails->sum('total_price') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="col-lg-8">
                    <h4 class="fw-bold text-white mb-3">Ordered Items</h4>

                    @if ($orderdetails->isEmpty())
                        <div class="product-card p-4 text-center">
                            <p class="text-muted mb-0">No items found for this order.</p>
                        </div>
                    @else
                        @foreach ($orderdetails as $item)
                            <div class="product-card p-4 mb-3">
                                <div class="row align-items-center">
                                    {{-- <div class="col-md-2 text-center mb-3 mb-md-0">
                                        @php
                                            // Find the specific product for this order item
                                            $currentProduct = $products->where('id', $item->product_id)->first();
                                            $img = $currentProduct?->firstVariantImage?->name;
                                            $imgPath =
                                                 $img && file_exists(public_path('variantThumbnail/' . $img))
                                                    ? url('variantThumbnail/' . $img)
                                                    : asset('images/no-image.jpg');
                                        @endphp

                                        <picture class="position-relative overflow-hidden d-block bg-light">
                                            <img class="w-100 img-fluid position-relative z-index-10"
                                                src="{{ $imgPath }}">
                                        </picture>
                                    </div> --}}
                                    <div class="col-md-2 text-center mb-3 mb-md-0">
                                        @php
                                            // Find the specific product for this order item
                                            $currentProduct = $products->where('id', $item->product_id)->first();
                                            // dd($currentProduct);
                                            // Try to find the specific variant based on order item properties

                                            $specificVariant = null;

                                            // If OrderItem has color information or size, match it with variants
                                            if ($variants->isNotEmpty()) {
                                                $productVariants = $variants->where('product_id', $item->product_id);

                                                // Itry to match by color_id
                                                if (!$specificVariant && isset($item->color_id) && $item->color_id) {
                                                    $specificVariant = $productVariants
                                                        ->where('color_id', $item->color_id)
                                                        ->first();
                                                        // dd('specified varaiant','specified varaint id:'.$specificVariant->id ,$specificVariant);
                                                }

                                                // Fallback to first variant of the product
                                                if (!$specificVariant) {
                                                    $specificVariant = $productVariants->first();
                                                }
                                            }

                                            // Now get the variant image based on the specific variant
                                            $img = null;
                                            if ($specificVariant && $variantImages->isNotEmpty()) {
                                                // Find variant image that matches this specific variant
                                                $variantImage = $variantImages
                                                    ->where('product_id', $item->product_id)
                                                    ->where('color_id', $specificVariant->color_id)
                                                    ->first();

                                                if ($variantImage) {
                                                    $img = $variantImage->name;
                                                }
                                            }

                                            // Fallback to first variant image if no specific match
                                            if (!$img && $currentProduct?->firstVariantImage) {
                                                $img = $currentProduct->firstVariantImage->name;
                                            }

                                            // Set image path
                                            $imgPath =
                                                $img && file_exists(public_path('variantThumbnail/' . $img))
                                                    ? url('variantThumbnail/' . $img)
                                                    : asset('images/no-image.jpg');
                                        @endphp

                                        <picture class="position-relative overflow-hidden d-block bg-light">
                                            <img class="img-fluid position-relative  product-image"
                                                src="{{ $imgPath }}"
                                                alt="{{ $item->product_name ?? 'Product Image' }}">
                                        </picture>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-1">{{ $item->product_name ?? 'Product Name' }}</h5>
                                        <p class="text-muted mb-1">
                                            <small>Product ID: {{ $item->product_id }}</small>
                                        </p>
                                        @if (isset($item->product->color))
                                            <p class="text-muted mb-1">
                                                <small>Color: {{ $item->product->color->name ?? 'N/A' }}</small>
                                            </p>
                                        @endif
                                        @if (isset($item->size))
                                            <p class="text-muted mb-0">
                                                <small>Size: {{ $item->size }}</small>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <div class="fw-bold">Qty: {{ $item->quantity }}</div>
                                        <small class="text-muted">₹{{ $item->price }} each</small>
                                    </div>

                                    <div class="col-md-2 text-end">
                                        <div class="fw-bold fs-5">₹{{ $item->price }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="{{ route('view.order') }}" class="btn btn-secondary me-2">
                        <i class="ri-list-check-line me-1"></i> View All Orders
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="ri-shopping-cart-2-line me-1"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

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
        }

        /* ✅ Make table header & row text white */
        .table thead th {
            color: #fff !important;
        }

        .table tbody tr td {
            color: #fff !important;
        }
    </style>

    <div class="custom-bg text-dark py-5">
        <div class="container">
            <h1 class="display-5 fw-bold text-center mb-4 text-white">My Orders</h1>

            @if ($orders->isEmpty())
                <p class="text-center text-white">You don’t have any orders yet.</p>
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-light fw-semibold rounded-pill px-4 py-2 custom-btn">
                        Go Shopping
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>User Email</th>
                                <th>Invoice ID</th>
                                <th>Order details</th>
                                <th>Delivery Status</th>
                                <th>Total Paid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>

                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->invoice_id }}</td>
                                    <td>
                                        <div>
                                            {{ $order->created_at->format('d M Y') }}
                                        </div>
                                        <div>
                                            Payment using:
                                            {{ $order->payment_method }}
                                        </div>
                                        <div>
                                            Payment Status:
                                            @if ($order->payment_status == 'Paid')
                                                <span style="color: rgb(0, 207, 0); font-weight: bold;">Paid</span>
                                            @else
                                                <span id='text-warning'>
                                                    <span style="color: rgb(207, 186, 0); font-weight: bold;">Awaiting
                                                        confirmation</span>
                                                </span>
                                            @endif
                                        </div>

                                    </td>
                                    <td>
                                        {{ $order->delivery_status }}
                                    </td>
                                    <td>₹{{ $order->total }}</td>
                                    <td>
                                    <a href="{{ route('view.order.details', $order->id) }}" class="btn btn-sm btn-primary">
                                        View 
                                    </a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <a href="{{ route('home') }}" class="btn btn-secondary" role="button">
            <i class="ri-shopping-cart-2-line align-bottom"></i> Go To Home
        </a>
    </div>
@endsection

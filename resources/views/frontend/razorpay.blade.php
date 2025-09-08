@extends('layouts.frontend.productpage.indexProductdetail')

@section('main-container')
    <div class="container text-center mt-5">
        <h2>Pay with Razorpay</h2>
        <p>Complete your payment to confirm your order</p>
        {{-- {{ dd($amount); }} --}}
        <button id="rzp-button1" class="btn btn-primary mt-3">Pay ₹{{ $amount / 100 }}</button>
        
        <div class="mt-4">
            <a href="{{ route('checkout.page') }}" class="btn btn-outline-secondary">Back to Checkout</a>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ $razorpayKey }}",
            "amount": "{{ $amount }}",
            "currency": "{{ $currency }}",
            "name": "My Laravel App",
            "description": "Order Payment",
            "order_id": "{{ $orderId }}",
            "handler": function(response) {
                // Show loading state
                document.getElementById('rzp-button1').disabled = true;
                document.getElementById('rzp-button1').innerHTML = 'Processing...';
                
                // Send response to backend
                fetch("{{ route('razorpay.order.payment') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify(response)
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert("Payment successful! Order created successfully.");
                            window.location.href = data.redirect_url;
                        } else {
                            alert(data.message || "Payment verification failed");
                            window.location.href = "{{ route('checkout.page') }}";
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("An error occurred while processing payment. Please contact support.");
                        window.location.href = "{{ route('checkout.page') }}";
                    });
            },
            "prefill": {
                "name": "{{ $customerName ?? 'Customer' }}",
                "email": "{{ $customerEmail ?? '' }}",
                "contact": ""
            },
            "theme": {
                "color": "#3399cc"
            },
            "modal": {
                "ondismiss": function() {
                    // User closed the payment modal
                    console.log("Payment cancelled by user");
                    // Optionally redirect back to checkout
                    // window.location.href = "{{ route('checkout.page') }}";
                }
            }
        };
        
        var rzp1 = new Razorpay(options);
        
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
        
        // Auto-trigger payment on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Uncomment the line below if you want to auto-open payment modal
            // rzp1.open();
        });
    </script>
@endsection
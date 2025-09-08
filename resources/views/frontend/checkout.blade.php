@extends('layouts.frontend.productpage.indexProductdetail')
@section('main-container')
    <!-- Main Section-->
    <section class="mt-5 container ">
        <!-- Page Content Goes Here -->

        <h1 class="mb-4 display-5 fw-bold text-center">Checkout Securely</h1>
        <p class="text-center mx-auto">Please fill in the details below to complete your order. Already registered?
            <a href="{{ route('user.login') }}">Login here.</a>
        </p>


        <div class="row g-md-8 mt-4">
            <div class="col-12 col-lg-6 col-xl-7">
                <form action="{{ route('payment.gateway') }}" method="POST"> @csrf
                    <!-- Checkout Panel Left -->
                    <div>
                        <!-- Checkout Panel Contact -->
                        <div class="checkout-panel">
                            <h5 class="title-checkout">Contact Information</h5>
                            <div class="row">

                                <!-- Email-->
                                <div class="col-12">
                                    <div class="form-group">
                                        @php
                                            if (!Auth::check()) {
                                                $user_email = '';
                                            } else {
                                                $user_email = Auth::user()->email;
                                            }
                                        @endphp
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ $user_email }}" placeholder="you@example.com">
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <!-- Mailing List Signup-->
                                    {{-- <div class="form-group form-check m-0">
                                        <input type="checkbox" class="form-check-input" id="add-mailinglist" checked>
                                        <label class="form-check-label" for="add-mailinglist">Keep me updated with your
                                            latest news
                                            and offers</label>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /Checkout Panel Contact --> <!-- Checkout Shipping Address -->
                        <div class="checkout-panel">
                            <h5 class="title-checkout">Shipping Address</h5>
                            <div class="row">
                                <!-- First Name-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstName" name="fname"
                                            placeholder="" value="" required="">
                                        <span class="text-danger">
                                            @error('fname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Last Name-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="lname"
                                            placeholder="" value="" required="">
                                        <span class="text-danger">
                                            @error('lname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Address-->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="123 Some Street Somewhere" required="">
                                        <span class="text-danger">
                                            @error('address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Country-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Country</label>
                                        {{-- <select class="form-select" name="country" id="country" required="">
                                        <option value="">Please Select...</option>
                                        <option>United States</option>
                                    </select> --}}
                                        <input type="text" class="form-control" name="country" id="country"
                                            placeholder="Enter country name here.." value="" required="">
                                        <span class="text-danger">
                                            @error('country')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- State-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state" class="form-label">State</label>
                                        {{-- <select class="form-select" name="state" id="state" required="">
                                        <option value="">Please Select...</option>
                                        <option>California</option>
                                    </select> --}}
                                        <input type="text" class="form-control" name="state" id="state"
                                            placeholder="Enter state name here..." value="" required="">
                                        <span class="text-danger">
                                            @error('state')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Post Code-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zip" class="form-label">Zip/Post Code</label>
                                        <input type="text" id='postalcode' name="postalcode" class="form-control"
                                            id="zip" placeholder="" required="">
                                        <span class="text-danger">
                                            @error('postalcode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="pt-4 mt-4 border-top d-flex justify-content-between align-items-center">
                                <!-- Shipping Same Checkbox-->
                                <div class="form-group form-check m-0">
                                    <input type="checkbox" class="form-check-input" id="same-address" checked>
                                    <label class="form-check-label" for="same-address">Use for billing address</label>
                                </div>
                            </div> --}}
                        </div>
                        <!-- /Checkout Shipping Address --> <!-- Checkout Billing Address-->
                        <div class="billing-address checkout-panel d-none">
                            {{-- <h5 class="title-checkout">Billing Address</h5> --}}
                            {{-- <div class="row">
                                <!-- First Name-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstNameAddress" class="form-label">First name</label>
                                        <input type="text" class="form-control" name="billing_fname"
                                            id="firstNameAddress" placeholder="" value="">
                                        <span class="text-danger">
                                            @error('billing_fname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Last Name-->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastNameAddress" class="form-label">Last name</label>
                                        <input type="text" class="form-control" name="billing_lname"
                                            id="lastNameAddress" placeholder="" value="">
                                        <span class="text-danger">
                                            @error('billing_lname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Address-->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="addressAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="billing_address"
                                            id="addressAddress" placeholder="123 Some Street Somewhere">
                                        <span class="text-danger">
                                            @error('billing_address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Country-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="countryAddress" class="form-label">Country</label>
                                        
                                        <input type="text" class="form-control" name="billing_country" id="country"
                                            placeholder="Enter country name here..." value="">
                                        <span class="text-danger">
                                            @error('billing_country')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- State-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stateAddress" class="form-label">State</label>
                                        
                                        <input type="text" class="form-control" name="billing_state" id="state"
                                            placeholder="Enter state name here..." value="">
                                        <span class="text-danger">
                                            @error('billing_state')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Post Code-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipAddress" class="form-label">Zip/Post Code</label>
                                        <input type="text" name="billing_postalcode" class="form-control"
                                            id="zipAddress" placeholder="">
                                        <span class="text-danger">
                                            @error('billing_postalcode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!-- / Checkout Billing Address--> <!-- Checkout Shipping Method-->
                        {{-- <div class="checkout-panel">
                            <h5 class="title-checkout">Shipping Method</h5>

                            <!-- Shipping Option-->
                            <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                <input class="form-check-input" type="radio" name="checkoutShippingMethod"
                                    id="checkoutShippingMethodOne" checked>
                                <label class="form-check-label" for="checkoutShippingMethodOne">
                                    <span class="d-flex justify-content-between align-items-start w-100">
                                        <span>
                                            <span class="mb-0 fw-bolder d-block">Click & Collect Shipping</span>
                                            <small class="fw-bolder">Collect from our store</small>
                                        </span>
                                        <span class="small fw-bolder text-uppercase">Free</span>
                                    </span>
                                </label>
                            </div>

                            <!-- Shipping Option-->
                            <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                <input class="form-check-input" type="radio" name="checkoutShippingMethod"
                                    id="checkoutShippingMethodTwo">
                                <label class="form-check-label" for="checkoutShippingMethodTwo">
                                    <span class="d-flex justify-content-between align-items-start">
                                        <span>
                                            <span class="mb-0 fw-bolder d-block">UPS Next Day</span>
                                            <small class="fw-bolder">For all orders placed before 1pm Monday to
                                                Thursday</small>
                                        </span>
                                        <span class="small fw-bolder text-uppercase">$19.99</span>
                                    </span>
                                </label>
                            </div>

                            <!-- Shipping Option-->
                            <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                <input class="form-check-input" type="radio" name="checkoutShippingMethod"
                                    id="checkoutShippingMethodThree">
                                <label class="form-check-label" for="checkoutShippingMethodThree">
                                    <span class="d-flex justify-content-between align-items-start">
                                        <span>
                                            <span class="mb-0 fw-bolder d-block">DHL Priority Service</span>
                                            <small class="fw-bolder">24 - 36 hour delivery</small>
                                        </span>
                                        <span class="small fw-bolder text-uppercase">$9.99</span>
                                    </span>
                                </label>
                            </div>
                        </div> --}}
                        <!-- /Checkout Shipping Method --> <!-- Checkout Payment Method-->
                        <div class="checkout-panel">
                            {{-- <h5 class="title-checkout">Payment Information</h5> --}}

                            <div class="row">
                                <!-- Payment Option-->
                                {{-- <div class="col-12">
                                <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                    <input class="form-check-input" type="radio" name="checkoutPaymentMethod"
                                        id="checkoutPaymentStripe" checked>
                                    <label class="form-check-label" for="checkoutPaymentStripe">
                                        <span class="d-flex justify-content-between align-items-start">
                                            <span>
                                                <span class="mb-0 fw-bolder d-block">Credit Card (Stripe)</span>
                                            </span>
                                            <i class="ri-bank-card-line"></i>
                                        </span>
                                    </label>
                                </div>
                            </div> --}}

                                <!-- Payment Option-->
                                <div class="col-12">
                                    {{-- <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                        <input class="form-check-input" type="radio" name="checkoutPaymentMethod"
                                            id="checkoutPaymentPaypal">
                                        <label class="form-check-label" for="checkoutPaymentPaypal">
                                            <span class="d-flex justify-content-between align-items-start">
                                                <span>
                                                    <span class="mb-0 fw-bolder d-block">PayPal</span>
                                                </span>
                                                <i class="ri-paypal-line"></i>
                                            </span>
                                        </label>
                                    </div> --}}
                                </div>

                            </div>

                            <!-- Payment Details-->
                            {{-- <div class="card-details">
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cc-name" class="form-label">Name on card</label>
                                        <input type="text" class="form-control" id="cc-name" placeholder=""
                                            required="">
                                        <small class="text-muted">Full name as displayed on card</small>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cc-number" class="form-label">Credit card number</label>
                                        <input type="text" class="form-control" id="cc-number" placeholder=""
                                            required="">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cc-expiration" class="form-label">Expiration</label>
                                        <input type="text" class="form-control" id="cc-expiration" placeholder=""
                                            required="">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <label for="cc-cvv"
                                                class="form-label d-flex w-100 justify-content-between align-items-center">Security
                                                Code</label>
                                            <button type="button" class="btn btn-link p-0 fw-bolder fs-xs text-nowrap"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="A CVV is a number on your credit card or debit card that's in addition to your credit card number and expiration date">
                                                What's this?
                                            </button>
                                        </div>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder=""
                                            required="">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                            <!-- / Payment Details-->

                            <!-- Paypal Info-->
                            <div class="paypal-details bg-light p-4 d-none mt-3 fw-bolder">
                                Please click on complete order. You will then be transferred to Paypal to enter your payment
                                details.
                            </div>
                            <!-- /Paypal Info-->
                        </div>
                        <!-- /Checkout Payment Method-->
                    </div>
                    <!-- / Checkout Panel Left -->
                    <button type="submit" id="completeOrderBtn" class="btn btn-dark w-100">Complete Order</button>

                </form>
            </div>

            <!-- Checkout Panel Summary -->
            <div class="col-12 col-lg-6 col-xl-5">
                <div class="bg-light p-4 sticky-md-top top-5">
                    <div class="border-bottom pb-3">
                        <!-- Cart Item-->
                        @foreach ($cartdata as $item)
                            <div
                                class="d-flex justify-content-between align-items-center py-3 px-2 mb-2 border rounded shadow-sm bg-white">
                                <!-- Product image + qty badge -->
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="position-relative me-3">
                                        <img src="{{ url('variantThumbnail/' . $item->options->image?->name) }}"
                                            alt="{{ $item->name }}" class="rounded img-fluid"
                                            style="width: 70px; height: auto;">

                                        <span
                                            class="badge bg-dark text-white position-absolute top-0 start-0 translate-middle rounded-pill">
                                            {{ $item->qty }}
                                        </span>
                                    </div>

                                    <!-- Product info -->
                                    <div>
                                        <p class="mb-1 fw-bold text-dark">{{ $item->name }}</p>
                                        <small class="text-muted">Size: {{ $item->options->Size }}</small>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="fw-bold text-end me-3 flex-shrink-0 fw-bolder">

                                    Rs. {{ number_format($item->qty * $item->price) }}
                                </div>

                                <!-- Remove button -->
                                <a href="{{ route('remove.from.cart', $item->rowId) }}"
                                    class="text-danger ms-2 text-decoration-none" title="Remove Item">
                                    <i class="ri-close-circle-line ri-xl"></i>
                                </a>
                            </div>
                        @endforeach

                        <!-- / Cart Item-->
                    </div>
                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="m-0 fw-bolder fs-6">Subtotal</p>
                            <p class="m-0 fs-6 fw-bolder">Rs. {{ $subtotal }}</p>
                        </div>
                        {{-- <div class="d-flex justify-content-between align-items-center ">
                                <p class="m-0 fw-bolder fs-6">Shipping</p>
                                <p class="m-0 fs-6 fw-bolder">8.95</p>
                            </div> --}}
                    </div>
                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-0 fw-bold fs-5">Grand Total</p>
                                {{-- <span class="text-muted small">Inc $45.89 sales tax</span> --}}
                            </div>
                            <p class="m-0 fs-5 fw-bold">{{ $subtotal }}</p>
                        </div>
                    </div>
                    {{-- <div class="py-3 border-bottom">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" placeholder="Enter your coupon code">
                            <button class="btn btn-dark btn-sm px-4">Apply</button>
                        </div>
                    </div> --}}
                    <!-- Accept Terms Checkbox-->
                    {{-- <div class="form-group form-check my-4">
                        <input type="checkbox" class="form-check-input" id="accept-terms" checked>
                        <label class="form-check-label fw-bolder" for="accept-terms">I agree to Alpine's <a
                                href="#">terms & conditions</a></label>
                    </div> --}}
                    {{-- <a href="#" class="btn btn-dark w-100" role="button">Complete Order</a> --}}
                </div>
            </div>
            <!-- /Checkout Panel Summary -->
        </div>

        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->
@endsection
@push('scripts')
    {{-- <script>
        document.getElementById('completeOrderBtn').addEventListener('click', function(e) {
            console.log("event occured");
            e.preventDefault(); // prevent default link behavior
            document.querySelector('form').submit(); // submit the first form on the page
        });
    </script> --}}
    <script>
        document.getElementById('completeOrderBtn').addEventListener('click', function(event) {
            event.preventDefault();

            const form = this.closest('form');
            const formData = new FormData(form);

            // Change form action to point to razorpay route
            const razorpayUrl = "{{ route('payment.gateway') }}";

            fetch(razorpayUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw errorData;
                        });
                    }
                    // If validation passes, the response will be the razorpay view
                    return response.text();
                })
                .then(data => {
                    // Write the razorpay page to current window
                    document.open();
                    document.write(data);
                    document.close();
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Clear previous error messages
                    document.querySelectorAll('.text-danger').forEach(span => span.innerText = '');

                    if (error.errors) {
                        // Show validation errors
                        for (const field in error.errors) {
                            const fieldElement = document.querySelector(`input[name="${field}"]`);
                            if (fieldElement) {
                                const errorSpan = fieldElement.parentElement.querySelector('.text-danger');
                                if (errorSpan) {
                                    errorSpan.innerText = error.errors[field][0];
                                }
                            }
                        }
                    } else {
                        alert(error.message || error.msg_send || 'An error occurred. Please try again.');
                    }
                });
        });
    </script>
  
@endpush

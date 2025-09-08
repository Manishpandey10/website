@extends('layouts.frontend.productpage.indexProductdetail')

@section('main-container')
    <section class="mt-5 container">
        <div class="row g-4 g-md-8 justify-content-center">

            <div class="col-12">
                <div class="alert alert-success text-center p-4 fw-bold">
                    Your order has been placed successfully! 
                    <br>
                    <small class="text-gray">
                        Thank You for shopping with us. 
                    </small>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6 d-flex justify-content-center">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center w-100">
                    <a href="{{ route('view.order') }}" class="btn btn-dark mt-3 flex-grow-1" role="button">
                        <i class="ri-shopping-cart-2-line align-bottom"></i> View Your Orders
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-dark mt-3 flex-grow-1" role="button">
                        <i class="ri-shopping-cart-2-line align-bottom"></i> Continue Shopping
                    </a>
                </div>
            </div>
            </div>
    </section>
@endsection
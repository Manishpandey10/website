@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="content-wrapper">
                <!-- Content -->
                <div class="row mb-12 mt-7 g-6 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            {{-- {{ dd(Auth::user()); }} --}}
                            <img class="card-img-top" src="{{ asset('storage/' . Auth::user()->image) }}" alt="Card image cap" />
                            <div class="card-body">
                                <h5 class="card-title"><strong>Name</strong> :{{ Auth::user()->name }} </h5>
                                   @if(Auth::user()->role_id == 1)
                                <p>Role: <span class="text-success"><strong>Admin</strong></span></p>
                                @endif
                                <hr>
                                <p class="card-text">
                                    <strong>Description</strong><br>
                                    This is a simple description paragraph line here.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

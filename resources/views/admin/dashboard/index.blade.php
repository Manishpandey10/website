@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Home</h5>
                            </div>
                            <br><br><br>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <span id="alert_msg" class="mx-6 mb-2 text-success">
                                @include('component.global-message')
                            </span>
                            <h6 class="mb-2 f-w-400 text-muted">Welcome to the Dashboard Admin...</h6>

                            <p class="mb-0 text-muted text-sm">You made an extra lorem ipsum

                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

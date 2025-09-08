@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new product type</h5>
                            <span id="alert_msg" class="text-danger mt-4 mx-4 ">
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST" action="{{ route('add.new.types') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Product Type
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" name="productType" id="">
                                            <option value="" disabled selected>Select Product type</option>
                                            <option value="Shoes">Shoes</option>
                                            <option value="Clothes">Clothes</option>
                                            <option value="Accessories">Accessories</option>
                                        </select>
                                        <span id="productType" class="text-danger">
                                            @error('productType')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>



                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Select Size
                                            <span style="color: #de0000">*</span>
                                        </label>

                                        <select class="form-control w-100" name="size[]" id="sizeSelect" multiple>
                                            <option disabled>Select size</option>
                                            <option value="UK 1">UK 1</option>
                                            <option value="UK 2">UK 2</option>
                                            <option value="UK 3">UK 3</option>
                                            <option value="UK 4">UK 4</option>
                                            <option value="UK 5">UK 5</option>
                                            <option value="UK 6">UK 6</option>
                                            <option value="UK 7">UK 7</option>
                                            <option value="UK 8">UK 8</option>
                                            <option value="UK 9">UK 9</option>
                                            <option value="UK 10">UK 10</option>
                                            <option value="UK 11">UK 11</option>
                                            <option value="UK 12">UK 12</option>
                                            <option value="24 (2-3 years)">24 (2-3 years)</option>
                                            <option value="26 (4-5 years)">26 (4-5 years)</option>
                                            <option value="28 (6-7 years)">28 (6-7 years)</option>
                                            <option value="30 (8-9 years)">30 (8-9 years)</option>
                                            <option value="32 (10-11 years)">32 (10-11 years)</option>
                                            <option value="34 (12-13 years)">34 (12-13 years)</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XXXL">XXXL</option>
                                            <option value="FS">FS</option>
                                            <option value="6 Oz">6 Oz</option>
                                            <option value="8 Oz">8 Oz</option>
                                            <option value="10 Oz">10 Oz</option>
                                            <option value="12 Oz">12 Oz</option>
                                            <option value="14 Oz">14 Oz</option>
                                            <option value="16 Oz">16 Oz</option>
                                            <option value="4 mm">4 mm</option>
                                            <option value="6 mm">6 mm</option>
                                            <option value="8 mm">8 mm</option>
                                            <option value="10 mm">10 mm</option>
                                        </select>

                                        <span id="size" class="text-danger">
                                            @error('size')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="my-7">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Add new product type
                                        </button>

                                    </div>



                            </form>

                        </div>
                    </div>
                </div>

                @push('scripts')
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#sizeSelect').select2({
                                placeholder: "Select Sizes",
                                allowClear: true,
                                width: '100%'
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#updateForm').on('submit', function(e) {
                                e.preventDefault(); // Stop normal form submission

                                let form = $(this);
                                let formData = new FormData(this);

                                $.ajax({
                                    url: form.attr('action'),
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    
                                    success: function(response) {
                                        // Redirect or show message
                                        // alert(response.message);
                                        // $alert_msg = response.message;

                                        // Flash the session message for the page to pick up
                                        // Store the message in a hidden div or some other element
                                        localStorage.setItem('flash_message', response.message);

                                        window.location.href = "{{ route('manage.types') }}";
                                        // $('#alert_msg').html(
                                        //     `<div class="alert alert-success alert-dismissible" role="alert">${alert_msg} </div>`
                                        // );

                                    },
                                    error: function(xhr) {
                                        if (xhr.status === 422) {
                                            let errors = xhr.responseJSON.errors;

                                            // Clear previous errors
                                            $('span.text-danger').html('');

                                            // Show new error messages
                                            $.each(errors, function(key, value) {
                                                $('#' + key).html(value[0]);
                                            });
                                        } else {
                                            alert('An error occurred. Please try again.');
                                            console.log(xhr.responseText);
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                @endpush
            @endsection

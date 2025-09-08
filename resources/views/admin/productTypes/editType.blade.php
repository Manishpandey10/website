@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit product type</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>
                        <div class="card-body">

                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.types', $editData->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Product Type
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" name="productType" id="">
                                            <option value="" disabled>Select Product type</option>
                                            <option value="Shoes"
                                                {{ $editData->productType == 'Shoes' ? 'selected' : '' }}>Shoes</option>
                                            <option value="Clothes"
                                                {{ $editData->productType == 'Clothes' ? 'selected' : '' }}>Clothes</option>
                                            <option value="Accessories"
                                                {{ $editData->productType == 'Accessories' ? 'selected' : '' }}>Accessories
                                            </option>
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
                                            @php
                                                $sizes = [
                                                    'UK 1',
                                                    'UK 2',
                                                    'UK 3',
                                                    'UK 4',
                                                    'UK 5',
                                                    'UK 6',
                                                    'UK 7',
                                                    'UK 8',
                                                    'UK 9',
                                                    'UK 10',
                                                    'UK 11',
                                                    'UK 12',
                                                    '24 (2-3 years)',
                                                    '26 (4-5 years)',
                                                    '28 (6-7 years)',
                                                    '30 (8-9 years)',
                                                    '32 (10-11 years)',
                                                    '34 (12-13 years)',
                                                    'S',
                                                    'M',
                                                    'L',
                                                    'XL',
                                                    'XXL',
                                                    'XXXL',
                                                    'FS',
                                                    '6 Oz',
                                                    '8 Oz',
                                                    '10 Oz',
                                                    '12 Oz',
                                                    '14 Oz',
                                                    '16 Oz',
                                                    '4 mm',
                                                    '6 mm',
                                                    '8 mm',
                                                    '10 mm',
                                                ];
                                            @endphp

                                            @foreach ($sizes as $size)
                                                <option value="{{ $size }}"
                                                    {{ in_array($size, $data) ? 'selected' : '' }}>{{ $size }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <span id="size" class="text-danger">
                                            @error('size')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="my-7">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Update
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
                        $('#updateForm').on('submit', function(e) {
                            e.preventDefault(); // Prevent default form submission

                            let form = $(this);
                            let url = form.attr('action');
                            let formData = form.serialize();

                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: formData,
                                success: function(response) {
                                    
                                    localStorage.setItem('flash_message', response.message);
                                    window.location.href = response.redirect_url;
                                },
                                error: function(xhr) {
                                    if (xhr.status === 422) {
                                        let errors = xhr.responseJSON.errors;
                                        if (errors.size) {
                                            $('#size').text(errors.size[0]);
                                        }
                                    } else {
                                        alert('Something went wrong. Please try again.');
                                    }
                                }
                            });
                        });
                    </script>
                @endpush
            @endsection

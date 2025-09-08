@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new Tax slab</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST" action="{{ route('add.new.tax.slab') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">GST Slab Rate Code
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="slabRateCode"
                                            placeholder="Enter GST slab rate code here" autofocus
                                            value="{{ old('slabRateCode') }}" />
                                        <span id="slabRateCode" class="text-danger">
                                            @error('slabRateCode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Product Price Limit
                                            <span style="color: #de0000">*</span>

                                        </label>
                                        <input type="number" class="form-control" name="pricelimit"
                                            placeholder="Enter Product Price limit here" autofocus
                                            value="{{ old('pricelimit') }}" />
                                        <span id="pricelimit" class="text-danger">
                                            @error('pricelimit')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Min Tax Rate
                                            <span style="color: #de0000">*</span>

                                        </label>
                                        <select name="minTax" id="" class="form-select">
                                            <option value="" selected>Select Tax Rate</option>
                                            <option value="1">0 %</option>
                                            <option value="2">3 %</option>
                                            <option value="3">5 %</option>
                                            <option value="4">6 %</option>
                                            <option value="5">12 %</option>
                                            <option value="6">18 %</option>
                                            <option value="7">28 %</option>
                                        </select>
                                        <span id="minTax" class="text-danger">
                                            @error('minTax')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Max Tax Rate
                                            <span style="color: #de0000">*</span>

                                        </label>
                                        <select name="maxTax" id="" class="form-select">
                                            <option value="" selected>Select Tax Rate</option>
                                            <option value="1">0 %</option>
                                            <option value="2">3 %</option>
                                            <option value="3">5 %</option>
                                            <option value="4">6 %</option>
                                            <option value="5">12 %</option>
                                            <option value="6">18 %</option>
                                            <option value="7">28 %</option>
                                        </select>
                                        <span id="maxTax" class="text-danger">
                                            @error('maxTax')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{-- <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Max Tax Rate
                                    <span style="color: #de0000">*</span>

                                        </label>
                                        <input type="text" class="form-control" name="maxTax"
                                            placeholder="Enter Max Tax Rate here" autofocus value="{{ old('maxTax') }}" />
                                        <span id="maxTax" class="text-danger">
                                            @error('maxTax')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}







                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Add new Tax slab rate
                                        </button>

                                    </div>



                            </form>

                        </div>
                    </div>
                </div>


                @push('scripts')
                    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
                                        // alert(response.message);
                                       
                                        localStorage.setItem('flash_message', response.message);

                                        window.location.href = "{{ route('manage.tax') }}";
                                        
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

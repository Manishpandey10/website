@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new Tag</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST" action="{{ route('add.new.tags') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Tag name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter name of tag here" autofocus value="{{ old('name') }}" />
                                        <span id="name" class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>





                                    <div class="col-6 mb-4">
                                        <label for="category" class="form-label">Status</label>
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option selected>Status </option>
                                            <option value="0"{{ old('status') == '0' ? 'selected' : '' }}>
                                                InActive
                                            </option>
                                            <option value="1"{{ old('status') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                        </select>
                                        <span id="status" class="text-danger">
                                            @error('status')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Add new Color
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
                                        // Redirect or show message
                                        // alert(response.message);
                                        // $alert_msg = response.message;

                                        // Flash the session message for the page to pick up
                                        // Store the message in a hidden div or some other element
                                        localStorage.setItem('flash_message', response.message);

                                        window.location.href = "{{ route('manage.tags') }}";
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

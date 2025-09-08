@extends('layouts.admin.app')
@section('main-container')
    <style>
        .dropzone {
            border: 2px dashed #ced4da;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s ease;
            font-family: sans-serif;
            font-size: 14px;
            color: #555;
        }

        .dropzone::after {
            content: "▼";
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 14px;
            color: #999;
        }

        .dropzone:hover {
            background-color: #f8f9fa;
            border-color: #86b7fe;
        }

        .dropzone.dragover {
            background-color: #e9f5ff;
            border-color: #0d6efd;
        }

        #fileInput {
            display: none;
        }
    </style>
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Filter Category</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>
                        <div class="card-body">

                            <form id="updateForm" method="POST" action="{{ route('update.filter', $editData->id) }}"
                                class="mb-6" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Filter Name</label>
                                        <input type="text" class="form-control" id="username" name="filtername"
                                            placeholder="Enter name of Product" autofocus value=" {{ $editData->name }}" />
                                        <span id="filtername" class="text-danger">
                                            @error('filtername')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="my-7">
                                        <button class="btn btn-btn-dark d-grid btn-md"
                                            style="background-color:rgb(252, 98, 41) !important;">Save</button>

                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
                @push('scripts')
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#updateForm').on('submit', function(e) {
                                e.preventDefault();

                                let form = $(this)[0];
                                let formData = new FormData(form);

                                $.ajax({
                                    url: $(this).attr('action'),
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(response) {
                                        localStorage.setItem('flash_message', response.message);
                                        window.location.href = `{{ route('manage.filter') }}`;
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
                                            console.error(xhr.responseText);
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                @endpush
            @endsection

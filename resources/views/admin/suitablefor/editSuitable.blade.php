@extends('layouts.admin.app')

@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add Suitable for </h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.suitable.for', $editData->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-6">
                                        <label for="username" class="form-label">Name</label>
                                        <span style="color: #de0000">*</span>

                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter name here" autofocus value="{{ $editData->name }}" />
                                        <span id="name" class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-6">
                                        <label class="form-file" for="basic-default-message">Upload Thumbnail
                                            {{-- <span style="color: #de0000">*</span> --}}
                                        </label>
                                        <input type="file" accept="image/jpeg, image/jpg, image/png"
                                            name="suitableFor_icon" id="basic-default-message" class="form-control"></input>
                                        <small id="emailHelp" class="form-text text-muted">Supported file formats =
                                            .JPG,.PNG,
                                            .JPEG</small>
                                        <br>
                                        <span id="suitableFor_icon" class="text-danger">
                                            @error('suitableFor_icon')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>



                                    <div class="mt-7">
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
                    <script>
                        $('#updateForm').on('submit', function(e) {
                            e.preventDefault();

                            let form = $(this)[0]; // Get the DOM element
                            let formData = new FormData(form); // Use FormData for file support
                            let url = $(this).attr('action');

                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: formData,
                                contentType: false, // Important for file upload
                                processData: false, // Important for file upload
                                success: function(response) {
                                    localStorage.setItem('flash_message', response.message);
                                    window.location.href = response.redirect_url;
                                },
                                error: function(xhr) {
                                    if (xhr.status === 422) {
                                        let errors = xhr.responseJSON.errors;
                                        if (errors.name) {
                                            $('#name').text(errors.name[0]);
                                        }
                                        if (errors.suitableFor_icon) {
                                            $('#suitableFor_icon').text(errors.suitableFor_icon[0]);
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

@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Update Tag</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.tags', $editData->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Tag name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter name of tag here" autofocus value="{{ $editData->name }}" />
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
                                            <option value="0"{{ $editData->status == '0' ? 'selected' : '' }}>
                                                InActive
                                            </option>
                                            <option value="1" {{ $editData->status == '1' ? 'selected' : '' }}>
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
                            e.preventDefault(); // Prevent default form submission

                            let form = $(this);
                            let url = form.attr('action');
                            let formData = form.serialize();

                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: formData,
                                success: function(response) {
                                    // alert(response.message); 
                                    localStorage.setItem('flash_message', response.message);
                                    window.location.href = response.redirect_url;
                                },
                                error: function(xhr) {
                                    if (xhr.status === 422) {
                                        let errors = xhr.responseJSON.errors;
                                        $('.text-danger').text('');

                                        $.each(errors, function(key, value) {
                                            
                                            $('#' + key).text(value[0]);
                                        });
                                    } else {
                                        alert('Something went wrong. Please try again.');
                                    }
                                }
                            });
                        });
                    </script>
                @endpush
            @endsection

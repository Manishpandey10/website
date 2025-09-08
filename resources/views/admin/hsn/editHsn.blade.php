@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new HSN Code</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.hsn', $hsnData->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">HSN Code</label>
                                        <input type="text" class="form-control" name="hsncode"
                                            placeholder="Enter HSN code here" autofocus value="{{ $hsnData->name }}" />
                                        <span id="hsncode" class="text-danger">
                                            @error('hsncode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>



                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Save
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
                                        if (errors.hsncode) {
                                            $('#hsncode').text(errors.hsncode[0]);
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

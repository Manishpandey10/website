@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mb-6 mt-6 gy-6 justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <span id="alert_msg" class="text-danger mt-4 mx-4 ">
                            {{-- @include('components.global-message') --}}
                        </span>

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Update Your Password</h5>
                        </div>
                        <div class="card-body">
                            <form id="updateForm" class="mb-6">
                                @csrf
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" id="cur_password" for="password">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="cur_password" />
                                    </div>
                                    <span id="curr_pass" class="text-danger">
                                        @error('cur_password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="basic-default-email">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="basic-default-email" class="form-control"
                                            aria-label="john.doe" aria-describedby="basic-default-email2"
                                            name="new_password" />
                                        <br>
                                    </div>
                                    <span id="new_pass" class="text-danger">
                                        @error('new_password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label form-password-toggle" for="basic-default-phone">Confirm New
                                        Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="basic-default-phone" class="form-control phone-mask"
                                            name="password_confirmation" />

                                    </div>

                                    <span id="confirm_pass" class="text-danger">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <button type="submit" class="btn btn-dark d-grid btn-md mt-4"  style="background-color:rgb(252, 98, 41) !important;">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#updateForm').on('submit', function(e) {
                    e.preventDefault();
                    // console.log("form submitted!");
                    const formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('admin.update.password') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            if (res.status === 'success') {
                                // console.log(res);
                                let alert_msg = res.changepasswordSuccess;
                                console.log(alert_msg);
                                $('#alert_msg').html(
                                    `<div class="alert alert-success alert-dismissible" role="alert">${alert_msg} </div>`
                                );
                                setTimeout(function() {
                                    $('#alert_msg').html('');
                                    window.location.href =
                                        "http://127.0.0.1:8000/admin/change-password";
                                }, 1500);
                            }
                            if (res.status === 'error') {
                                let alert_msg = res.changePasswordError;
                                $('#alert_msg').html(
                                    `<div class="alert alert-danger alert-dismissible" role="alert">${alert_msg} </div>`
                                );
                                setTimeout(function() {
                                    $('#alert_msg').html('');
                                    window.location.href =
                                        "http://127.0.0.1:8000/admin/change-password";
                                }, 3000);
                            }

                        },
                        error: function(error) {
                            console.log(error);

                            $('.text-danger').html('');

                            // 

                            const formError = error.responseJSON.errors;
                            console.log(formError);

                            $('.text-danger').html('');
                            if (formError.cur_password) {
                                $('#curr_pass').html(formError.cur_password[0]);
                            }
                            if (formError.new_password) {
                                $('#new_pass').html(formError.new_password[0]);
                            }
                            if (formError.password_confirmation) {
                                $('#confirm_pass').html(formError.password_confirmation[0]);
                            }

                        }

                    });
                });



            });

        </script>
    @endpush
@endsection

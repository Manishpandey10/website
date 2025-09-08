@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new Color</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>

                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST" action="{{ route('add.new.color') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Product Color</label>
                                        <input type="text" class="form-control" name="colorname"
                                            placeholder="Enter name of color" autofocus value="{{ old('colorname') }}" />
                                        <span id="colorname" class="text-danger">
                                            @error('colorname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-6 mb-4 position-relative">
                                        <label for="color-select" class="form-label">Pick Color</label>

                                        <div class="input-group">
                                            <span class="input-group-text p-0">
                                                <div id="color-picker" style="width: 40px; height: 38px; cursor: pointer;">
                                                </div>
                                            </span>
                                            <input type="text" class="form-control" id="color-select" name="colorcode"
                                                placeholder="Click picker to select" readonly
                                                value="{{ old('colorcode', '#000000') }}" />

                                        </div>

                                        <span class="text-danger">
                                            @error('colorcode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>




                                    <div class="my-7">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Add new Color
                                        </button>

                                    </div>



                            </form>

                        </div>
                    </div>
                </div>

                {{-- @push('scripts')
                    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
                    <script>
                        const pickr = Pickr.create({
                            el: '#color-picker',
                            theme: 'classic',
                            default: '#424242',
                            components: {
                                preview: true,
                                opacity: true,
                                hue: true,
                                interaction: {
                                    input: true,
                                    save: true,
                                    clear: true
                                }
                            }
                        });

                        pickr.on('save', (color, instance) => {
                            const hexColor = color.toHEXA().toString();
                            document.getElementById('color-select').value = hexColor;
                            instance.hide();
                        });
                    </script>
                @endpush --}}
                @push('scripts')
                    {{-- Include Pickr --}}
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
                    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

                    <script>
                        const pickr = Pickr.create({
                            el: '#color-picker',
                            theme: 'classic',
                            default: '{{ old('colorcode', '#000000') }}',
                            components: {
                                preview: true,
                                opacity: true,
                                hue: true,
                                interaction: {
                                    hex: true,
                                    input: true,
                                    save: true,
                                    clear: true
                                }
                            }
                        });

                        pickr.on('save', (color, instance) => {
                            const hexColor = color.toHEXA().toString();
                            document.getElementById('color-select').value = hexColor;
                            instance.hide();
                        });

                        // Optional: live preview update
                        pickr.on('change', (color) => {
                            const hexColor = color.toHEXA().toString();
                            document.getElementById('color-select').value = hexColor;
                        });
                    </script>
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
                                        window.location.href = response.redirect_url;
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

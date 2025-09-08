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
                            <h5 class="mb-0">Edit color</h5>
                            <span>
                                {{-- {{ dd($editData->colorCode); }} --}}
                                @include('component.global-message')
                            </span>
                        </div>
                        <div class="card-body">

                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.color', $editData->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Product Color</label>
                                        <input type="text" class="form-control" name="colorname"
                                            placeholder="Enter name of color" autofocus value="{{ $editData->name }}" />
                                        <span id="colorname" class="text-danger">
                                            @error('colorname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>



                                    {{-- <div class="col-6 mb-4">
                                        <label for="colorpicker" class="form-label">Pick Color</label>
                                        <div id="color-picker">
                                        
                                        </div>
                                        <input type="text" class="form-control mt-2" id="color-select" name="colorcode"
                                            placeholder="Enter color code value" readonly value="{{ old('colorcode') }}" />
                                        <span class="text-danger">
                                            @error('colorcode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}
                                    <div class="col-6 mb-4 position-relative">
                                        <label for="color-select" class="form-label">Pick Color</label>

                                        <div class="input-group">
                                            <span class="input-group-text p-0">
                                                <div id="color-picker" style="width: 40px; height: 38px; cursor: pointer;">
                                                </div>
                                            </span>
                                            {{-- <input type="text" class="form-control" id="color-select" name="colorcode"
                                                placeholder="Click picker to select" readonly
                                                value="{{ old('colorcode', '#000000') }}" /> --}}
                                            <input type="text" class="form-control" id="color-select" name="colorcode"
                                                placeholder="Click picker to select" readonly
                                                value="{{$editData->colorCode ?? '#000000'}}" />

                                        </div>

                                        <span class="text-danger">
                                            @error('colorcode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    {{-- status for color by default 1(Active) --}}
                                    {{-- <div class="col-12 mb-4 mt-2">
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
                                    </div> --}}

                                    <div class="my-7">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Add new Color
                                        </button>

                                    </div>



                            </form>

                        </div>
                    </div>
                </div>
                @push('scripts')
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
                    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <script>
                        const pickr = Pickr.create({
                            el: '#color-picker',
                            theme: 'classic',
                            default: document.getElementById('color-select').value || '#000000',
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

                        pickr.on('change', (color) => {
                            const hexColor = color.toHEXA().toString();
                            document.getElementById('color-select').value = hexColor;
                        });
                    </script>
    {{-- ajax code --}}
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

                                        // Clear previous errors
                                        $('.text-danger').text('');

                                        // Loop through the errors
                                        $.each(errors, function(key, value) {
                                            // Set the error message to the span with id same as the field name
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

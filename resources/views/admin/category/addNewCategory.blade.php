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
                            <h5 class="mb-0">Add new product category</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>
                        <div class="card-body shadow p-3 bg-white rounded">
                            <form id="updateForm" class="mb-6" method="POST" action="{{ route('add.new.category') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-12 mb-4">
                                        <label for="username" class="form-label">Product Category Name</label>
                                        <input type="text" class="form-control" id="Category_name" name="categoryname"
                                            placeholder="Enter name of category" autofocus
                                            value="{{ old('categoryname') }}" />
                                        <span id="categoryname" class="text-danger">
                                            @error('categoryname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Meta Title</label>
                                        <input type="text" class="form-control" id="Category_name" name="metaTitle"
                                            placeholder="Enter meta title for  category" autofocus
                                            value="{{ old('metaTitle') }}" />
                                        <span id="metaTitle" class="text-danger">
                                            @error('metaTitle')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter meta Description</label>
                                        <input type="text" class="form-control" id="Category_name" name="metaDescription"
                                            placeholder="Enter meta description for category" autofocus
                                            value="{{ old('metaDescription') }}" />
                                        <span id="metaDescription" class="text-danger">
                                            @error('metaDescription')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="category" class="form-label">Select Parent Category</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="parentCategory">

                                            <option selected>Select Parent category </option>
                                            {{-- <option value="null">Null option </option> --}}

                                            @foreach ($categoryData as $parent)
                                                <option value="{{ $parent->id }}"
                                                    {{ old('parentCategory') == $parent->parent_id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                                @if ($parent->subcategory->isNotEmpty())
                                                    {
                                                    @foreach ($parent->subcategory as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ old('parentCategory') == $data->id ? 'selected' : '' }}>
                                                            &nbsp;&nbsp;--{{ $data->name }}
                                                        </option>
                                                    @endforeach
                                                    }
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-6 mb-6">
                                        <label class="form-file" for="basic-default-message">Upload Thumbnail</label>
                                        <input type="file" accept="image/jpeg, image/jpg, image/png"
                                            name="category_thumbnail" id="basic-default-message" class="form-control"
                                            multiple></input>
                                        <small id="emailHelp" class="form-text text-muted">Supported file formats =
                                            .JPG,.PNG,
                                            .JPEG</small>
                                        <br>
                                        <span id="category_thumbnail" class="text-danger">
                                            @error('category_thumbnail')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-12 mb-4 mt-2">
                                        <label for="category" class="form-label">Status</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="productStatus">
                                            <option selected>Status </option>
                                            <option value="0"{{ old('productStatus') == '0' ? 'selected' : '' }}>
                                                InActive
                                            </option>
                                            <option value="1"{{ old('productStatus') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                        </select>
                                        <span id="productStatus" class="text-danger">
                                            @error('productStatus')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="my-7">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color: rgb(252, 98, 41) !important;">Add new product
                                            category</button>

                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>

                @push('scripts')
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <script>
                        let fileInput = document.getElementById('fileInput');
                        let storedFiles = [];

                        function previewImage(event) {
                            const files = Array.from(event.target.files);
                            storedFiles = files; // initialize stored files

                            const preview = document.getElementById('image-preview');
                            preview.innerHTML = '';

                            storedFiles.forEach((file, index) => {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    let imageContainer = document.createElement('div');
                                    imageContainer.style.display = 'inline-block';
                                    imageContainer.style.margin = '10px';
                                    imageContainer.style.position = 'relative';

                                    let img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.style.maxHeight = '150px';
                                    img.style.maxWidth = '150px';
                                    img.style.display = 'block';

                                    let btn = document.createElement('button');
                                    btn.type = 'button';
                                    btn.innerText = "Remove";
                                    btn.style.marginTop = '5px';
                                    btn.style.width = '100%';

                                    btn.onclick = function() {
                                        // Remove the image container from DOM
                                        imageContainer.remove();

                                        // Remove file from storedFiles
                                        storedFiles.splice(index, 1);

                                        // Create a new DataTransfer object and add remaining files
                                        const dataTransfer = new DataTransfer();
                                        storedFiles.forEach(file => dataTransfer.items.add(file));

                                        // Update the input field's file list
                                        fileInput.files = dataTransfer.files;

                                        console.log('File removed from input and DOM.');
                                    };

                                    imageContainer.appendChild(img);
                                    imageContainer.appendChild(btn);
                                    preview.appendChild(imageContainer);
                                };

                                reader.readAsDataURL(file);
                            });
                        }
                    </script>
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
                                        window.location.href = `{{ route('manage.category') }}`;
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

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
                            <h5 class="mb-0">Edit Product Category</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>
                        <div class="card-body">

                            <form id="updateForm" method="POST"
                                action="{{ route('submit.edit.category', $categoryEditData->id) }}" class="mb-6"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Category Name</label>
                                        <input type="text" class="form-control" id="username" name="categoryname"
                                            placeholder="Enter name of category" autofocus
                                            value=" {{ $categoryEditData->name }}" />
                                        <span id="categoryname" class="text-danger">
                                            @error('categoryname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>



                                    {{-- <div class="col-6 mb-6">
                                        <label class="form-file" for="basic-default-message">Upload Thumbnail</label>
                                        <input type="file" accept="image/jpeg, image/jpg, image/png" name="thumbnail"
                                            id="basic-default-message" class="form-control">

                                        </input>
                                        <small id="emailHelp" class="form-text text-muted">Supported file formats =
                                            .JPG,.PNG,
                                            .JPEG</small>
                                        <br>

                                        <span id="thumbnail" class="text-danger">
                                            @error('thumbnail')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}
                                    {{--  --}}
                                   
                                    {{--  --}}
                                    <div class="col-6 mb-4">
                                        <label for="category" class="form-label">Select Parent Category</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="parentCategory">

                                            <option selected>Select Parent category </option>
                                            {{-- <option value="null">Null option </option> --}}

                                            @foreach ($categoryData as $parent)
                                                <option value="{{ $parent->id }}"
                                                    {{ $categoryEditData->id == $parent->id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                                @if ($parent->subcategory->isNotEmpty())
                                                    {
                                                    @foreach ($parent->subcategory as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ $categoryEditData->id == $data->id ? 'selected' : '' }}>
                                                            &nbsp;&nbsp;--{{ $data->name }}
                                                        </option>
                                                    @endforeach
                                                    }
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Meta title</label>
                                        <input type="text" class="form-control" id="Category_name" name="metaTitle"
                                            placeholder="Enter meta title for category" autofocus
                                            value="{{ $categoryEditData->metaTitle }}" />
                                        <span id="metaTitle" class="text-danger">
                                            @error('metaTitle')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter meta description</label>
                                        <input type="text" class="form-control" id="Category_name" name="metaDescription"
                                            placeholder="Enter meta description for category" autofocus
                                            value="{{ $categoryEditData->metaDescription }}" />
                                        <span id="metaDescription" class="text-danger">
                                            @error('metaDescription')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{--  --}}
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
                                    {{--  --}}
                                    
                                    <div class="col-12 mb-4">
                                        <label for="category" class="form-label">Status</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="productStatus">
                                            <option selected>Status </option>
                                            <option value="0"{{ $categoryEditData->status == '0' ? 'selected' : '' }}>
                                                Unlisted
                                            </option>
                                            <option value="1"{{ $categoryEditData->status == '1' ? 'selected' : '' }}>
                                                Listed
                                            </option>
                                        </select>
                                        <span id="productStatus" class="text-danger">
                                            @error('productStatus')
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
                @endpush
            @endsection

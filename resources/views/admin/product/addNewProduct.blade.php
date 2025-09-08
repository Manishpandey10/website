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
            content: "";
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

        .note-toolbar {
            position: relative;
            background-color: #80808069;
        }
    </style>
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new product</h5>
                            <span>
                                @include('component.global-message')
                            </span>
                        </div>
                        <div class="card-body shadow p-3 mb-5 bg-white rounded">

                            <form id="updateForm" method="POST" action="{{ route('add.new.product') }}" class="mb-6"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Product Name
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="productname"
                                            placeholder="Enter name of Product" autofocus
                                            value="{{ old('productname') }}" />
                                        <span id="productname" class="text-danger">
                                            @error('productname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Product Description
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="productDescription"
                                            placeholder="Enter Description of Product" autofocus
                                            value="{{ old('productDescription') }}" />
                                        <span id="productDescription" class="text-danger">
                                            @error('productDescription')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Barcode (ISBN, UPC, GTIN, etc.)
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="barcode"
                                            placeholder="Enter Barcode (ISBN, UPC, GTIN, etc.)" autofocus
                                            value="{{ old('barcode') }}" />
                                        <span id="barcode" class="text-danger">
                                            @error('barcode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Article Code
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="articleCode"
                                            placeholder="Enter Article code here" autofocus
                                            value="{{ old('articleCode') }}" />
                                        <span id="articleCode" class="text-danger">
                                            @error('articleCode')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Brand
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" name="brand" id="">
                                            <option value="" disabled selected>Select Brand</option>
                                            <option value="1">Nike</option>
                                            <option value="2">Puma</option>
                                            <option value="3">Adidas</option>
                                        </select>
                                        <span id="brand" class="text-danger">
                                            @error('brand')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="categorySelect" class="form-label">Product Category
                                            <span style="color: #de0000">*</span>

                                        </label>
                                        <select class="form-control w-100" id="categorySelect" name="productCategory[]"
                                            multiple>
                                            @foreach ($categoryData as $parent)
                                                <option value="{{ $parent->id }}"
                                                    {{ is_array(old('productCategory')) && in_array($parent->id, old('productCategory')) ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>

                                                @if ($parent->subcategory->isNotEmpty())
                                                    @foreach ($parent->subcategory as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ is_array(old('productCategory')) && in_array($data->id, old('productCategory')) ? 'selected' : '' }}>
                                                            &nbsp;&nbsp;--{{ $data->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>

                                        <span id="productCategory" class="text-danger">
                                            @error('productCategory')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>




                                    {{-- <div class="col-6 mb-6">
                                        <label class="form-file" for="basic-default-message">Upload Thumbnail</label>
                                        <input type="file" accept="image/jpeg, image/jpg, image/png"
                                            name="product_thumbnail[]" id="basic-default-message" class="form-control"
                                            multiple></input>
                                        <small id="emailHelp" class="form-text text-muted">Supported file formats =
                                            .JPG,.PNG,
                                            .JPEG</small>
                                        <br>
                                        <span id="product_thumbnail" class="text-danger">
                                            @error('product_thumbnail')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}

                                    <div class="col-6 mb-4">
                                        <label for="filterSelect" class="form-label">Select Filter
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-control w-100" id="filterSelect" name="filter[]" multiple>
                                            @foreach ($filterData as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <span id="filter" class="text-danger">
                                            @error('filter')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{-- product color select option --}}
                                    {{-- <div class="col-6 mb-4">
                                        <label for="filterSelect" class="form-label">Select Product Color</label>
                                        <select class="form-select" name="productColor">
                                            <option value=""disabled selected>Select Product Color</option>
                                            @foreach ($colorData as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <span id="productColor" class="text-danger">
                                            @error('productColor')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}

                                    {{-- product types select option --}}
                                    <div class="col-6 mb-4">
                                        <label for="filterSelect" class="form-label">Select Product Type
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" name="productType">
                                            <option value="" disabled selected>Select Product Type</option>
                                            @foreach ($typeData as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <span id="productType" class="text-danger">
                                            @error('productType')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{-- suitable for option  --}}
                                    <div class="col-6 mb-4">
                                        <label for="filterSelect" class="form-label">Suitable For
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" id="suitableSelect" name="suitable[]" multiple>
                                            <option value="" disabled>Select suitable for </option>
                                            @foreach ($suitableData as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <span id="suitable" class="text-danger">
                                            @error('suitable')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>


                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Meta Title
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="username" name="metaTitle"
                                            placeholder="Enter meta title for Product" autofocus
                                            value="{{ old('metaTitle') }}" />
                                        <span id="metaTitle" class="text-danger">
                                            @error('metaTitle')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Product Highlights
                                            {{-- <span style="color: #de0000">*</span> --}}
                                        </label>
                                        <input type="text" class="form-control" id="username"
                                            name="productHighlight" placeholder="Enter meta title for Product" autofocus
                                            value="{{ old('productHighlight') }}" />
                                        <span id="productHighlight" class="text-danger">
                                            @error('productHighlight')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Meta Description
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="username" name="metaDescription"
                                            placeholder="Enter meta description for Product" autofocus
                                            value="{{ old('metaDescription') }}" />
                                        <span id="metaDescription" class="text-danger">
                                            @error('metaDescription')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Price (in Rs.)
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="number" class="form-control" name="price"
                                            placeholder="Enter price of Product" autofocus value="{{ old('price') }}" />
                                        <span id="price" class="text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Stock
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" class="form-control"
                                                placeholder="Enter stock value of the product" name="stock"
                                                rows="3" value="{{ old('stock') }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
                                        <span id="stock" class="text-danger">
                                            @error('stock')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>

                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Fabric/Material</label>
                                        <input type="text" class="form-control" name="material"
                                            placeholder="Enter material of Product" autofocus
                                            value="{{ old('material') }}" />
                                        <span id="material" class="text-danger">
                                            @error('material')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Discount ( in % )
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="number" class="form-control" name="discount"
                                            placeholder="Enter discount for Product" autofocus
                                            value="{{ old('discount') }}" />
                                        <span id="discount" class="text-danger">
                                            @error('discount')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-6 mb-4">
                                        <label for="category" class="form-label">Status
                                            <span style="color: #de0000">*</span>
                                        </label>
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
                                    <div class="col-6 mb-4">
                                        <label for="category" class="form-label">Gender
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" aria-label="Default select example" name="gender">
                                            <option selected>Select gender </option>
                                            <option value="0"{{ old('gender') == '0' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="1"{{ old('gender') == '1' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="2"{{ old('gender') == '1' ? 'selected' : '' }}>
                                                Unisex
                                            </option>
                                        </select>
                                        <span id="gender" class="text-danger">
                                            @error('gender')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="category" class="form-label">Tags
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" id="tagSelect" multiple
                                            aria-label="Default select example" name="tags[]">
                                            <option value="" disabled>Select tags </option>
                                            @foreach ($tagsData as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <span id="tags" class="text-danger">
                                            @error('tags')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{-- Packing information --}}
                                    {{-- <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Packing information
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="number" class="form-control" name="packingInfo"
                                            placeholder="Enter Packing information" disabled
                                            value="{{ old('packingInfo') }}" />
                                        <span id="productname" class="text-danger">
                                            @error('packingInfo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Packed by
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="number" class="form-control" name="packerInfo"
                                            placeholder="Enter packer information" disabled
                                            value="{{ old('packerInfo') }}" />
                                        <span id="productname" class="text-danger">
                                            @error('packerInfo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}
                                    {{-- packing information option ends --}}

                                    {{-- product image code starts here --}}
                                    {{-- <div class="col-6 mb-6 mt-3">

                                        <label for="fileInput" class="dropzone">
                                            Insert image(s) for product here
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="file" onchange="previewImage(event)"
                                            accept="image/jpeg, image/jpg, image/png" name="productthumbnail[]"
                                            id="fileInput" class="form-control" multiple>
                                        </input>
                                        <div id="image-preview"></div>

                                        <small id="emailHelp" class="form-text text-muted">Supported file formats =
                                            .JPG,.PNG,
                                            .JPEG</small>
                                        <span id="productthumbnail" class="text-danger">
                                            @error('productthumbnail')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}
{{-- cod eends here --}}

                                    {{-- <div id="notepad-container" class="col-12 mb-5"
                                        style="max-width:540px; border:1px dashed #aaa; padding:24px; margin-left:8px; margin-top:4px; border-radius:8px; background:#f9f9f9;">
                                        <div
                                            style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                                            <h4>Additional information</h4>
                                            <select id="noteOptions" onchange="handleOption(this.value)">
                                                <option value="">Options</option>
                                                <option value="clear">Clear</option>
                                                <option value="small">Small Font</option>
                                                <option value="medium">Medium Font</option>
                                                <option value="large">Large Font</option>
                                            </select>
                                        </div>

                                        <div id="dropzone" ondrop="handleDrop(event)"
                                            ondragover="event.preventDefault()"
                                            style="border:2px dashed #ccc; padding:20px; min-height:80px; background:white; border-radius:6px;"
                                            contenteditable="true">
                                            Drop a .txt file here or start typing...
                                        </div>
                                    </div> --}}
                                    <div class="col-6 mb-5">
                                        <label for="summernote" class="form-label">Additional Information</label>
                                        <textarea name="additionalInfo" id="summernote" cols="30" rows="10">{{ old('additionalInfo') }}</textarea>
                                    </div>


                                    {{-- return and replacement option --}}
                                    {{-- <div class="col-12 mb-4">
                                        <h5 style="background: #a5a4a4;    border-radius: 6px;">Return and replacement</h5>
                                        <span class="p-1">
                                            <input type="radio" id="Return" name="returnType" value="Return">
                                            <label for="Return"
                                                style="font-weight: normal;font-weight: normal;font-size: 19px;cursor: pointer;">N/A</label>
                                        </span>
                                        <span class="p-1">
                                            <input type="radio" id="Return" name="returnType" value="Return">
                                            <label for="Return"
                                                style="font-weight: normal;font-weight: normal;font-size: 19px;cursor: pointer;">Return
                                                & Replacement</label>
                                        </span>
                                    </div> --}}
                                    {{-- return and re[lacement option disabled --}}
                                    <div class="my-7">
                                        <button type="submit" class="btn btn-dark text-white d-grid btn-md"
                                            style="background-color:rgb(252, 98, 41) !important;">Add new product</button>

                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
                @push('scripts')
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    {{-- Summernote --}}

                    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
                     {{-- ajax submission form --}}
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
                    {{-- ajax form submission cancel --}}
                    <script>
                        $(document).ready(function() {
                            $('#summernote').summernote({
                                placeholder: 'Write additional information here...',
                                tabsize: 2,
                                height: 200
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#categorySelect').select2({
                                placeholder: "Select Product Categories",
                                allowClear: true,
                                width: '100%'
                            });
                            $('#filterSelect').select2({
                                placeholder: "Select Product Filters",
                                allowClear: true,
                                width: '100%'

                            });
                            $('#suitableSelect').select2({
                                placeholder: "Select Suitable For",
                                allowClear: true,
                                width: '100%'

                            });
                            $('#tagSelect').select2({
                                placeholder: "Select Tags",
                                allowClear: true,
                                width: '100%'

                            });

                        });
                    </script>
                   




                    {{-- //for multiple image upload preview and delete preview.. --}}
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
                    {{-- for handling additional information  --}}
                    <script>
                        function handleDrop(event) {
                            event.preventDefault();
                            const file = event.dataTransfer.files[0];
                            if (file && file.type === "text/plain") {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    document.getElementById('dropzone').innerText = e.target.result;
                                };
                                reader.readAsText(file);
                            } else {
                                alert("Only .txt files are supported.");
                            }
                        }

                        function handleOption(value) {
                            const dropzone = document.getElementById('dropzone');
                            switch (value) {
                                case 'clear':
                                    dropzone.innerText = '';
                                    break;
                                case 'small':
                                    dropzone.style.fontSize = '12px';
                                    break;
                                case 'medium':
                                    dropzone.style.fontSize = '16px';
                                    break;
                                case 'large':
                                    dropzone.style.fontSize = '20px';
                                    break;
                            }
                            document.getElementById('noteOptions').value = ''; // reset select
                        }
                    </script>
                @endpush
            @endsection

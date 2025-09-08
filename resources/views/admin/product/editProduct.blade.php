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

                            <h5 class="mb-0">Edit the product details </h5>
                        </div>

                        <div class="mx-5">
                            <small class="form-text text-muted">Edit the details you want to edit for the existing product
                                category</small>
                        </div>
                        <div class="card-body">
                            {{-- {{ dd($productdata->filters); }} --}}
                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('submit.edit.product', $productdata->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Enter Product Name
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="username" name="productname"
                                            placeholder="Enter name of product" autofocus
                                            value="{{ $productdata->name }}" />
                                        <span id="productname" class="text-danger">
                                            @error('productname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Enter Product description
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control"
                                                placeholder="Enter description of the product" name="productDescription"
                                                rows="3" value="{{ $productdata->description }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
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
                                            value="{{ $productdata->barcode }}" />
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
                                            value="{{ $productdata->articleCode }}" />
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
                                        <label for="filterSelect" class="form-label">Suitable For
                                            {{-- <span style="color: #de0000">*</span> --}}
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
                                        <label for="filterSelect" class="form-label">Select Filter
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-control" id="filterSelect" name="filter[]" multiple>
                                            @if (count($productdata->filters) != 0)
                                                @foreach ($productdata->filters as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ in_array($data->id, $productdata->filters->pluck('id')->toArray()) ? 'selected' : '' }}>

                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                            {{-- by default if there is no data about the filters associated to the filter in pivot table --}}
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
                                   
                                    <div class="col-6 mb-4">
                                        <label for="filterSelect" class="form-label">Select Product Type
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        &nbsp;
                                        @if ($productdata->productType == '')
                                            <small class="text-danger">There is no product type associated to this
                                                product*</small>
                                        @endif
                                        <select class="form-select" name="productType">
                                            <option value="" disabled selected>Select Product Type</option>
                                            @foreach ($typeData as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $productdata->productType == $item->id ? 'selected' : '' }}>
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


                                    <div class="col-6 mb-4">
                                        <label for="categorySelect" class="form-label">Category
                                            <span style="color: #de0000">*</span>
                                        </label>

                                        <select class="form-control" id="categorySelect" name="productCategory[]"
                                            multiple>

                                            @if (count($productdata->products_category) != 0)
                                                @foreach ($productdata->products_category as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ in_array($data->id, $productdata->products_category->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            @endif
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



                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Enter Meta Title
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control"
                                                placeholder="Enter meta title for the product" name="metaTitle"
                                                rows="3" value="{{ $productdata->metaTitle }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
                                        <span id="metaTitle" class="text-danger">
                                            @error('metaTitle')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>
                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Enter Meta description
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control"
                                                placeholder="Enter meta description for the product"
                                                name="metaDescription" rows="3"
                                                value="{{ $productdata->metaDescription }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
                                        <span id="metaDescription" class="text-danger">
                                            @error('metaDescription')
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
                                            value="{{ $productdata->highlight }}" />
                                        <span id="productHighlight" class="text-danger">
                                            @error('productHighlight')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="username" class="form-label">Fabric/Material</label>
                                        <input type="text" class="form-control" name="material"
                                            placeholder="Enter material of Product" autofocus
                                            value="{{ $productdata->material }}" />
                                        <span id="material" class="text-danger">
                                            @error('material')
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
                                    <div class="col-6 mb-4">
                                        <label for="category" class="form-label">Gender
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <select class="form-select" aria-label="Default select example" name="gender">
                                            <option selected>Select gender </option>
                                            <option value="0"{{ $productdata->gender == '0' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="1"{{ $productdata->gender == '1' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="2"{{ $productdata->gender == '1' ? 'selected' : '' }}>
                                                Unisex
                                            </option>
                                        </select>
                                        <span id="gender" class="text-danger">
                                            @error('gender')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{-- produc thumbnail code  --}}
                                    {{-- <div class="col-6 mb-6 mt-3">
                                        <label for="fileInput" class="dropzone">
                                            Drag & drop files here, or click to browse
                                        </label>
                                        <input type="file" onchange="previewImage(event)"
                                            accept="image/jpeg, image/jpg, image/png" name="productthumbnail[]"
                                            id="fileInput" class="form-control" multiple />
                                        <div id="image-preview">
                                            <div class="img">
                                               
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">Supported file formats =
                                            .JPG,.PNG,
                                            .JPEG</small>
                                        <span id="productthumbnail" class="text-danger">
                                            @error('productthumbnail')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}
                                    {{--  --}}
                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Price
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" class="form-control"
                                                placeholder="Enter price of the product" name="price" rows="3"
                                                value="{{ $productdata->actualPrice }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
                                        <span id="price" class="text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>
                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Stock
                                            <span style="color: #de0000">*</span> </label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" class="form-control"
                                                placeholder="Enter description of the product" name="stock"
                                                rows="3" value="{{ $productdata->stock }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
                                        <small>you can change the stock value here </small>
                                        <span id="stock" class="text-danger">
                                            @error('stock')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>
                                    <div class="col-6 mb-6">
                                        <label class="form-label" for="description">Discount
                                            <span style="color: #de0000">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" class="form-control"
                                                placeholder="Enter description of the product" name="discount"
                                                rows="3" value="{{ $productdata->discount }}" />
                                            <span class="input-group-text cursor-pointer"></span>
                                        </div>
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
                                            <option value="1" {{ $productdata->status == '1' ? 'selected' : '' }}>
                                                Listed</option>
                                            <option value="0" {{ $productdata->status == '0' ? 'selected' : '' }}>
                                                Unlisted</option>
                                        </select>

                                        <span id="productStatus" class="text-danger">
                                            @error('productStatus')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-6 mb-5">
                                        <label for="summernote" class="form-label">Additional Information</label>
                                        <textarea name="additionalInfo" id="summernote" cols="30" rows="10">{{ old('additionalInfo') }}</textarea>
                                    </div>



                                    <div class="my-7">
                                        <button class="btn btn-dark d-grid btn-md"
                                            style="background-color:rgb(252, 98, 41) !important;">Save</button>

                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
                @push('scripts')
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- if not already included -->
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    {{-- Summernote --}}

                    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

                    {{-- ajax fr submitting form --}}
                    <script>
                        $('#updateForm').on('submit', function(e) {
                            e.preventDefault(); // Prevent default form submission
                            $('.text-danger').text('');

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
                    {{--  --}}
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

                    {{-- for multiple images --}}
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

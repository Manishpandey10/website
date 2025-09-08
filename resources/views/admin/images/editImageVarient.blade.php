@extends('layouts.admin.app')

@section('main-container')
    <style>
        .dropzone {
            border: 2px dashed #8e9eae;
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
    </style>
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">

                <div class="col-12">

                    <div class="card">
                        
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Preview the product thumbnail and submit </h5>
                        </div>

                        <div class="card-body">
                            <div>
                                <span class="form-text text-muted">To delete any image Click on remove and then click on
                                    Save
                                    button
                                </span>
                            </div>

                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.image.variant', ['color_id' => $colorId, 'product_id' => $productdata->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-6 mb-6 mt-3">
                                    <label for="fileInput" class="dropzone">
                                        For addding new product images, insert files here
                                    </label>
                                    <input type="file" onchange="previewImage(event)"
                                        accept="image/jpeg, image/jpg, image/png" name="variantthumbnail[]" id="fileInput"
                                        class="form-control" multiple />

                                    <span id="variantthumbnail" class="text-danger">
                                        @error('variantthumbnail')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <span>
                                    <small class="form-text text-warning text-muted mt-4">You can remove the images by
                                        clicking on remove buttons </small>
                                </span>
                                <div class="col-6 mb-6 mt-3" id="image-preview">
                                    <div class="img"
                                        style="background:#dad8d8; display:inline-block; position: relative; ">
                                        @foreach ($imagedata as $image)
                                            <div class="imagecontainer" id="img-{{ $image->id }}"
                                                style="display: inline-block; margin:10px; position: relative;">
                                                <div class="img">
                                                    <img src="{{ asset('variantThumbnail/' . $image->name) }}"
                                                        width="150px" height="150px" alt="Thumbnail">
                                                </div>
                                                <button type="button" class="btn btn-sm btn-light mt-2"
                                                    onclick="removeExistingImage({{ $image->id }})">Remove</button>
                                                <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="remove_images" id="removeImages">

                                    </div>
                                </div>
                                <div class="mt-5">
                                    <button class="btn btn-dark d-grid btn-md"
                                        style="background-color:rgb(252, 98, 41) !important;">Save</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    <script>
                        let removeList = [];

                        function removeExistingImage(id) {
                            const container = document.getElementById(`img-${id}`);
                            if (container) container.remove();
                            removeList.push(id);
                            document.getElementById('removeImages').value = removeList.join(',');
                        }

                        let fileInput = document.getElementById('fileInput');
                        let storedFiles = [];

                        function previewImage(event) {
                            const files = Array.from(event.target.files);
                            storedFiles = files;
                            const preview = document.getElementById('image-preview');
                            preview.innerHTML = '';

                            storedFiles.forEach((file) => {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    const imageContainer = document.createElement('div');
                                    imageContainer.style.display = 'inline-block';
                                    imageContainer.style.margin = '10px';
                                    imageContainer.style.position = 'relative';

                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.style.maxHeight = '150px';
                                    img.style.background = ' #dad8d8';
                                    img.style.maxWidth = '150px';
                                    img.style.display = 'block';

                                    const btn = document.createElement('button');
                                    btn.type = 'button';
                                    btn.innerText = "Remove";
                                    btn.className = "btn btn-sm btn-danger mt-2";

                                    btn.onclick = function() {
                                        imageContainer.remove();
                                        storedFiles = storedFiles.filter(f => f !== file);
                                        const dt = new DataTransfer();
                                        storedFiles.forEach(f => dt.items.add(f));
                                        fileInput.files = dt.files;
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

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
    {{-- <div class="pc-container">
        <div class="pc-content">
            <div class="row mx-4 mt-6 justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h5 class="mb-0">Preview the product thumbnail and submit </h5>
                        </div>

                        <div class="mx-5 mt-4">
                            <span class="form-text text-muted">Here you can preview or remove images associated to the
                                product</span>
                        </div>
                        <div class="card-body">

                            <form id="updateForm" class="mb-6" method="POST"
                                action="{{ route('update.image', $productdata->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-6 mb-6 mt-3">
                                    <label for="fileInput" class="dropzone">
                                        For addding new product images, insert files here
                                    </label>
                                    <input type="file" onchange="previewImage(event)"
                                        accept="image/jpeg, image/jpg, image/png" name="productthumbnail[]" id="fileInput"
                                        class="form-control" multiple />

                                    <span id="productthumbnail" class="text-danger">
                                        @error('productthumbnail')
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
                                        @foreach ($imageData as $image)
                                            <div class="imagecontainer" id="img-{{ $image->id }}"
                                                style="display: inline-block; margin:10px; position: relative;">
                                                <div class="img">
                                                    <img src="{{ asset('ProductThumbnail/' . $image->name) }}"
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
    </div> --}}
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">

                <h5 class="card-header">Manage images </h5>
                <span id="alert_msg" class="text-success mt-6 mb-4 ">
                    @include('component.global-message')
                </span>

                <div class="mt-6">
                </div>
                <div class="card-body shadow p-3 bg-white rounded">
                    <div class="card-body p-3 mb-5 bg-gray rounded" style="background-color: #e3e0e0">
                        <p style="margin-bottom: 4px;font-size: 15px;">Product Name :{{ $productdata->name }}</p>
                        <p style="margin-bottom: 4px;font-size: 15px;">Article code: @if ($productdata->articleCode == '')
                                -- N/A --
                            @else
                                {{ $productdata->articleCode }}
                            @endif
                        </p>
                        <p style="margin-bottom: 4px;font-size: 15px;">Brand:
                            @if ($productdata->brand == '')
                                -- N/A --
                            @else
                                {{ $productdata->brand }}
                            @endif
                        </p>
                    </div>
                    {{-- <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;">
                       
                        <a href="{{ route('handle.image', $productdata->id) }}" class=" link link-light">
                            Change images
                        </a>&nbsp;&nbsp;
                    </button> --}}
                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;">

                        <a href="{{ route('image.variant', $productdata->id) }}" class=" link link-light">
                            Add new product image
                        </a>
                    </button>


                    {{-- {{ dd($imageData->name); }} --}}
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colorData as $data)
                                    <tr>
                                        {{-- Color info --}}
                                        <td class="d-flex align-items-center">
                                            <div
                                                style="width: 12px; height: 12px; background-color: {{ $data->colorCode }}; border-radius: 50%; margin-right: 8px;">
                                            </div>
                                            {{ $data->name }}
                                        </td>

                                        {{-- Images under this color --}}
                                        <td>
                                            @if ($imagesGroupedByColor->has($data->id))
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($imagesGroupedByColor[$data->id] as $image)
                                                        <div class="text-center me-2 mb-2">
                                                            <img src="{{ asset('variantThumbnail/' . $image->name) }}"
                                                                width="80" height="80" class="border rounded" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">No images for this color.</span>
                                            @endif
                                        </td>
                                        <td>

                                            <div>
                                                <button type="button" class=" btn btn-light "
                                                    style="background-color:rgb(252, 98, 41) !important;">
                                                    <a href="{{ route('edit.image.variant', ['color_id' => $data->id, 'product_id' => $productdata->id]) }}"
                                                        class=" link link-light">
                                                        Edit
                                                    </a>
                                                </button>
                                                <button type="button" class=" btn btn-light "
                                                    style="background-color:rgb(252, 98, 41) !important;">
                                                    <a href="{{ route('delete.image.variant', ['color_id' => $data->id, 'product_id' => $productdata->id]) }}"
                                                        class=" link link-light"
                                                        onclick="return confirm('This action will delete all images! Are you sure ?')">
                                                        Delete
                                                    </a>
                                                </button>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

        <!-- jQuery (required by DataTables) -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#product-table').DataTable({
                    "pageLength": 10,
                    "lengthChange": true,
                    "ordering": true,
                    language: {
                        searchPlaceholder: 'Search by color...'// Set your desired placeholder text here
                    },
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                });
            });
        </script>
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

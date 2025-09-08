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

        select.form-control {

            appearance: none;
            background: #ffffff;
        }

        F .dropzone.dragover {
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
            <div class="card mx-4 mt-6">
                <div class="card-body shadow p-3 bg-white rounded">
                    <span id="alert_msg" class="text-success mt-6 mb-4 ">
                            @include('component.global-message')
                        </span>

                    <form method="POST" class="mb-6" id="variantForm"
                        action="{{ route('add.image.variant', $productdata->id) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Color Selection -->
                        {{-- <div class="form-group mb-3">
                            <label for="color">Select Color <span class="text-danger">*</span></label>
                            <select name="color" class="form-control" required>
                                <option value="">Select Color</option>
                                @foreach ($colordata as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="color" class="text-danger">
                                @error('color')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> --}}
                        {{--  color selection over --}}
                        <div class="form-group mb-3">
                            <label for="color">Select Color <span class="text-danger">*</span></label>
                            <select name="color" id="color" class="form-control select2" required>
                                <option value="">Select Color</option>
                                @foreach ($colordata as $data)
                                    <option value="{{ $data->id }}" data-color={{ $data->colorCode }}>
                                        <span>
                                            {{ $data->name }}
                                        </span>
                                    </option>
                                @endforeach
                            </select>
                            <span id="color" class="text-danger">
                                @error('color')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <h5>Color wise Image</h5>

                        <div class="col-6 mb-6 mt-3">
                            <label for="fileInput" class="dropzone">
                                For addding new product images, insert files here
                            </label>
                            <input type="file" onchange="previewImage(event)" accept="image/jpeg, image/jpg, image/png"
                                name="productthumbnail[]" id="fileInput" class="form-control" multiple />

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
                            <div class="img" style="background:#dad8d8; display:inline-block; position: relative; ">
                                {{-- @foreach ($imageData as $image)
                                    <div class="imagecontainer" id="img-{{ $image->id }}"
                                        style="display: inline-block; margin:10px; position: relative;">
                                        <div class="img">
                                            <img src="{{ asset('ProductThumbnail/' . $image->name) }}" width="150px"
                                                height="150px" alt="Thumbnail">
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light mt-2"
                                            onclick="removeExistingImage({{ $image->id }})">Remove</button>
                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                    </div>
                                @endforeach --}}
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
    </div>
    @push('scripts')
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                let form = document.getElementById('variantForm');
                let colorSelect = document.getElementById('color');

                form.addEventListener('submit', function(e) {
                    const selectedColorId = colorSelect.value;

                    if (selectedColorId) {
                        // Modify the action with selected color as a GET param
                        let baseAction = "{{ route('add.image.variant', $productdata->id) }}";
                        form.action = `${baseAction}?color=${selectedColorId}`;
                    }
                });
            });
        </script> --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    

        <script>
            $(document).ready(function() {
                //attaching the color id in the link so that i can be retreived at controller
                $('#variantForm').on('submit', function(e) {
                    const selectedColorId = $('#color').val();

                    if (selectedColorId) {
                        const baseAction = "{{ route('add.image.variant', $productdata->id) }}";
                        this.action = `${baseAction}?color=${selectedColorId}`;
                    }
                });
                $('#color').select2({
                    placeholder: "Select Variant color",
                    allowClear: true,
                    width: '100%',
                    templateResult: formatColorOption,
                    templateSelection: formatColorOption,

                });
                $('#color').on('select2:open', function(e) {
                    $('.select2-search__field').attr('placeholder', 'Type here to search...');
                });

                function formatColorOption(state) {
                    if (!state.id) {
                        return state.text; // default for placeholder
                    }

                    var colorCode = $(state.element).data('color');

                    var $state = $(`
                         <span style="display: flex; align-items: center;">
                        <span style="width: 12px; height: 12px; background-color: ${colorCode}; border-radius: 50%;  margin-right: 8px;"></span>
                        ${state.text}
                         </span>`);
                    return $state;
                }

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

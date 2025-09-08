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

                    <form method="POST"
                        action="{{ route('update.varient', ['variant_id' => $editdata->id, 'product_id' => $productdata->id]) }}">
                        @csrf
                        {{-- {{ dd($productdata->name); }} --}}
                        <!-- Color Selection -->
                        <div class="form-group mb-3">
                            <label for="color">Select Color <span class="text-danger">*</span></label>
                            <select name="color" id="color" class="form-control select2" required>
                                {{-- <option value="">Select Color</option> --}}
                                {{-- @foreach ($colordata as $data) --}}
                                    <option value="{{ $colordata->id }}" data-color={{ $colordata->colorCode }}
                                        {{ $editdata->color_id == $colordata->id ? 'selected' : '' }}>
                                        <span>
                                            {{ $colordata->name }}
                                        </span>
                                    </option>
                                {{-- @endforeach --}}
                            </select>
                            <span id="color" class="text-danger">
                                @error('color')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label for="metaTitle" class="form-label">Enter Meta title
                                    <span style="color: #de0000">*</span>
                                </label>
                                <input type="text" class="form-control"  name="metaTitle"
                                    placeholder="Enter meta Title for Product" autofocus
                                    value="{{$editdata->metaTitle}}" />
                                <span id="metaTitle" class="text-danger">
                                    @error('metaTitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-4">
                                <label for="metaDescription" class="form-label">Enter Meta Description
                                    <span style="color: #de0000">*</span>
                                </label>
                                <input type="text" class="form-control"  name="metaDescription"
                                    placeholder="Enter meta description for Product" autofocus
                                    value="{{ $editdata->metaDescription }}" />
                                <span id="metaDescription" class="text-danger">
                                    @error('metaDescription')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-4">
                                <label for="variantImgTitle" class="form-label">Variant Images Title
                                    <span style="color: #de0000">*</span>
                                </label>
                                <input type="text" class="form-control"  name="variantImgTitle"
                                    placeholder="Enter variant image title" autofocus
                                    value="{{ $editdata->variantImgTitle }}" />
                                <span id="variantImgTitle" class="text-danger">
                                    @error('variantImgTitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-4">
                                <label for="variantImgAltTag" class="form-label">Variant Images alt tag
                                    <span style="color: #de0000">*</span>
                                </label>
                                <input type="text" class="form-control"  name="variantImgAltTag"
                                    placeholder="Enter Variant image alt tag value" autofocus
                                    value="{{$editdata->variantImgAltTag}}" />
                                <span id="variantImgAltTag" class="text-danger">
                                    @error('variantImgAltTag')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div> 

                        <h5>Size Variants</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Enable</th>
                                    <th>Size</th>
                                    <th>SKU</th>
                                    <th>Stock Quantity</th>
                                    <th>Weight (gm)</th>
                                    <th>Price (in Rs.)</th>
                                    <th>Discount (in %.)</th>
                                    <th>HSN</th>
                                    <th>GST Slab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- First Row -->
                                {{-- <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row1"></td>
                                    <td><input type="text" name="value1" class="form-control row1" value="24 (2-3 Years)" disabled></td>
                                    <td><input type="text" name="sku1" class="form-control row1" disabled></td>
                                    <td><input type="number" name="stock1" class="form-control row1" disabled></td>
                                    <td><input type="number" name="weight1" class="form-control row1" disabled></td>
                                    <td>
                                        <select name="hsn1" class="form-control row1" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst1" class="form-control row1" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> --}}
                                @php
                                    $sizeMap = [
                                        '24 (2-3 Years)' => 1,
                                        '26 (4-5 Years)' => 2,
                                        '28 (6-7 Years)' => 3,
                                        '30(8-9 Years)' => 4,
                                        '32(10-11 Years)' => 5,
                                        '34(12-13 Years)' => 6,
                                        'XS' => 7,
                                        'S' => 8,
                                        'M' => 9,
                                        'L' => 10,
                                        'XL' => 11,
                                        'XXL' => 12,
                                        'XXXL' => 13,
                                        'FS' => 14,
                                    ];
                                @endphp

                                @for ($i = 1; $i <= 14; $i++)
                                    @php
                                        $sizeName = array_search($i, $sizeMap);
                                        $variant = $relatedVariants->firstWhere('size', $sizeName);
                                    @endphp

                                    <tr>
                                        <td>
                                            <input type="checkbox" class="toggle-row" data-target="row{{ $i }}"
                                                {{ in_array($i, $rowsToEnable) ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="value{{ $i }}"
                                                class="form-control row{{ $i }}" value="{{ $sizeName }}"
                                                readonly {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>

                                        </td>
                                        <td>
                                            <input type="text" name="sku{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                value="{{ old("sku$i", $variant?->sku) }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>
                                        </td>

                                        <td>
                                            <input type="text" name="stock{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                value="{{ old("stock$i", $variant?->stock) }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="weight{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                value="{{ old("weight$i", $variant?->weight) }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="price{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                value="{{ old("price$i", $variant?->price) }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="discount{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                value="{{ old("discount$i", $variant?->discount) }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <select name="hsn{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>

                                                <option value="">Select HSN</option>
                                                @foreach ($hsn as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $variant?->hsn == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="gst{{ $i }}"
                                                class="form-control row{{ $i }}"
                                                {{ in_array($i, $rowsToEnable) ? '' : 'disabled' }}>

                                                <option value="">Select GST</option>
                                                @foreach ($gst as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $variant?->gst == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                @endfor
                                <!-- Second Row -->

                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.querySelectorAll('.toggle-row').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const targetClass = this.dataset.target; // 'row1', 'row2'
                    const inputs = document.querySelectorAll('.' + targetClass);
                    inputs.forEach(input => {
                        input.disabled = !this.checked;
                    });
                });
            });
        </script>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- Summernote --}}

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#color').select2({
                    placeholder: "Select Variant color",
                    width: '100%',
                    templateResult: formatColorOption,
                    templateSelection: formatColorOption,
                    minimumResultsForSearch: Infinity

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
    @endpush
@endsection

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

                    <form id="updateForm" method="POST" action="{{ route('add.new.varient', $productdata->id) }}">
                        @csrf

                        <!-- Color Selection -->

                        <div class="form-group mb-3">
                            <label for="color">Select Color <span class="text-danger">*</span></label>
                            <select name="color" id="color" class="form-control select2" >
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
                        {{-- meta title / meta description / variant   --}}
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label for="metaTitle" class="form-label">Enter Meta title
                                    <span style="color: #de0000">*</span>
                                </label>
                                <input type="text" class="form-control" id="metaTitle" name="metaTitle"
                                    placeholder="Enter meta Title for Product" autofocus value="{{ old('metaTitle') }}"
                                     />
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
                                <input type="text" class="form-control" id="metaDescription" name="metaDescription"
                                    placeholder="Enter meta description for Product" autofocus
                                    value="{{ old('metaDescription') }}"  />
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
                                <input type="text" class="form-control" id="variantImgTitle" name="variantImgTitle"
                                    placeholder="Enter variant image title" autofocus value="{{ old('variantImgTitle') }}"
                                     />
                                <span id="variantImgTitle" class="text-danger">
                                    @error('variantImgTitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-4">
                                <label for="variantImgAltTag" class="form-label">
                                    Variant Images alt tag <span style="color: #de0000">*</span>
                                </label>
                                <input type="text" class="form-control" id="variantImgAltTag" name="variantImgAltTag"
                                    placeholder="Enter Variant image alt tag value" value="{{ old('variantImgAltTag') }}"
                                     />
                            </div>
                            <span id="variantImgAltTag" class="text-danger">
                                @error('variantImgAltTag')
                                    {{ $message }}
                                @enderror
                            </span>

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
                                    <th>Discount (in %)</th>
                                    <th>HSN</th>
                                    <th>GST Slab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- First Row -->
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row1"></td>
                                    <td><input type="text" name="value1" class="form-control row1"
                                            value="24 (2-3 Years)" disabled></td>
                                    <td><input type="text" name="sku1" class="form-control row1" disabled></td>
                                    <td><input type="number" name="stock1" class="form-control row1" disabled></td>

                                    <td><input type="number" name="weight1" class="form-control row1" disabled></td>
                                    <td><input type="number" name="price1" class="form-control row1" disabled></td>
                                    <td><input type="number" name="discount1" class="form-control row1" disabled></td>
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
                                </tr>

                                <!-- Second Row -->
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row2"></td>
                                    <td><input type="text" name="value2" class="form-control row2"
                                            value="26 (4-5 Years)" disabled></td>
                                    <td><input type="text" name="sku2" class="form-control row2" disabled></td>
                                    <td><input type="number" name="stock2" class="form-control row2" disabled></td>

                                    <td><input type="number" name="weight2" class="form-control row2" disabled></td>
                                    <td><input type="number" name="price2" class="form-control row2" disabled></td>
                                    <td><input type="number" name="discount2" class="form-control row2" disabled></td>
                                    <td>
                                        <select name="hsn2" class="form-control row2" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst2" class="form-control row2" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- thisrd row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row3"></td>
                                    <td><input type="text" name="value3" class="form-control row3"
                                            value="28 (6-7 Years)" disabled></td>
                                    <td><input type="text" name="sku3" class="form-control row3" disabled></td>
                                    <td><input type="number" name="stock3" class="form-control row3" disabled></td>
                                    <td><input type="number" name="weight3" class="form-control row3" disabled></td>
                                    <td><input type="number" name="price3" class="form-control row3" disabled></td>
                                    <td><input type="number" name="discount3" class="form-control row3" disabled></td>
                                    <td>
                                        <select name="hsn3" class="form-control row3" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst3" class="form-control row3" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 4th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row4"></td>
                                    <td><input type="text" name="value4" class="form-control row4"
                                            value=" 30(8-9 Years)" disabled></td>
                                    <td><input type="text" name="sku4" class="form-control row4" disabled></td>
                                    <td><input type="number" name="stock4" class="form-control row4" disabled></td>
                                    <td><input type="number" name="weight4" class="form-control row4" disabled></td>
                                    <td><input type="number" name="price4" class="form-control row4" disabled></td>
                                    <td><input type="number" name="discount4" class="form-control row4" disabled></td>
                                    <td>
                                        <select name="hsn4" class="form-control row4" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst4" class="form-control row4" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 5th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row5"></td>
                                    <td> <input type="text" name="value5" class="form-control row5"
                                            value="32(10-11 Years)" disabled></td>
                                    <td><input type="text" name="sku5" class="form-control row5" disabled></td>
                                    <td><input type="number" name="stock5" class="form-control row5" disabled></td>
                                    <td><input type="number" name="weight5" class="form-control row5" disabled></td>
                                    <td><input type="number" name="price5" class="form-control row5" disabled></td>
                                    <td><input type="number" name="discount5" class="form-control row5" disabled></td>
                                    <td>
                                        <select name="hsn5" class="form-control row5" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst5" class="form-control row5" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 6th row --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row6"></td>
                                    <td><input type="text" name="value6" class="form-control row6"
                                            value="34(12-13 Years)" disabled> </td>
                                    <td><input type="text" name="sku6" class="form-control row6" disabled></td>
                                    <td><input type="number" name="stock6" class="form-control row6" disabled></td>
                                    <td><input type="number" name="weight6" class="form-control row6" disabled></td>
                                    <td><input type="number" name="price6" class="form-control row6" disabled></td>
                                    <td><input type="number" name="discount6" class="form-control row6" disabled></td>
                                    <td>
                                        <select name="hsn6" class="form-control row6" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst6" class="form-control row6" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 7th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row7"></td>
                                    <td> <input type="text" name="value7" class="form-control row7" value="XS"
                                            disabled></td>
                                    <td><input type="text" name="sku7" class="form-control row7" disabled></td>
                                    <td><input type="number" name="stock7" class="form-control row7" disabled></td>
                                    <td><input type="number" name="weight7" class="form-control row7" disabled></td>
                                    <td><input type="number" name="price7" class="form-control row7" disabled></td>
                                    <td><input type="number" name="discount7" class="form-control row7" disabled></td>
                                    <td>
                                        <select name="hsn7" class="form-control row7" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst7" class="form-control row7" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 8th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row8"></td>
                                    <td><input type="text" name="value8" class="form-control row8" value="S"
                                            disabled></td>
                                    <td><input type="text" name="sku8" class="form-control row8" disabled></td>
                                    <td><input type="number" name="stock8" class="form-control row8" disabled></td>
                                    <td><input type="number" name="weight8" class="form-control row8" disabled></td>
                                    <td><input type="number" name="price8" class="form-control row8" disabled></td>
                                    <td><input type="number" name="discount8" class="form-control row8" disabled></td>
                                    <td>
                                        <select name="hsn8" class="form-control row8" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst8" class="form-control row8" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 9th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row9"></td>
                                    <td><input type="text" name="value9" class="form-control row9" value="M"
                                            disabled> </td>
                                    <td><input type="text" name="sku9" class="form-control row9" disabled></td>
                                    <td><input type="number" name="stock9" class="form-control row9" disabled></td>
                                    <td><input type="number" name="weight9" class="form-control row9" disabled></td>
                                    <td><input type="number" name="price9" class="form-control row9" disabled></td>
                                    <td><input type="number" name="discount9" class="form-control row9" disabled></td>
                                    <td>
                                        <select name="hsn9" class="form-control row9" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst9" class="form-control row9" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 10th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row10"></td>
                                    <td><input type="text" name="value10" class="form-control row10" value="L"
                                            disabled> </td>
                                    <td><input type="text" name="sku10" class="form-control row10" disabled></td>
                                    <td><input type="number" name="stock10" class="form-control row10" disabled></td>
                                    <td><input type="number" name="weight10" class="form-control row10" disabled></td>
                                    <td><input type="number" name="price10" class="form-control row10" disabled></td>
                                    <td><input type="number" name="discount10" class="form-control row10" disabled></td>
                                    <td>
                                        <select name="hsn10" class="form-control row10" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst10" class="form-control row10" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 11 row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row11"></td>
                                    <td> <input type="text" name="value11" class="form-control row11" value="XL"
                                            disabled> </td>
                                    <td><input type="text" name="sku11" class="form-control row11" disabled></td>
                                    <td><input type="number" name="stock11" class="form-control row11" disabled></td>
                                    <td><input type="number" name="weight11" class="form-control row11" disabled></td>
                                    <td><input type="number" name="price11" class="form-control row11" disabled></td>
                                    <td><input type="number" name="discount11" class="form-control row11" disabled></td>
                                    <td>
                                        <select name="hsn11" class="form-control row11" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst11" class="form-control row11" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 12th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row12"></td>
                                    <td> <input type="text" name="value12" class="form-control row12" value="XXL"
                                            disabled> </td>
                                    <td><input type="text" name="sku12" class="form-control row12" disabled></td>
                                    <td><input type="number" name="stock12" class="form-control row12" disabled></td>
                                    <td><input type="number" name="weight12" class="form-control row12" disabled></td>
                                    <td><input type="number" name="price12" class="form-control row12" disabled></td>
                                    <td><input type="number" name="discount12" class="form-control row12" disabled></td>
                                    <td>
                                        <select name="hsn12" class="form-control row12" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst12" class="form-control row12" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 13th row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row13"></td>
                                    <td><input type="text" name="value13" class="form-control row13" value="XXXL"
                                            disabled> </td>
                                    <td><input type="text" name="sku13" class="form-control row13" disabled></td>
                                    <td><input type="number" name="stock13" class="form-control row13" disabled></td>
                                    <td><input type="number" name="weight13" class="form-control row13" disabled></td>
                                    <td><input type="number" name="price13" class="form-control row13" disabled></td>
                                    <td><input type="number" name="discount13" class="form-control row13" disabled></td>
                                    <td>
                                        <select name="hsn12" class="form-control row12" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst13" class="form-control row13" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                {{-- 14thr row  --}}
                                <tr>
                                    <td><input type="checkbox" class="toggle-row" data-target="row14"></td>
                                    <td><input type="text" name="value14" class="form-control row14" value="FS"
                                            disabled></td>
                                    <td><input type="text" name="sku14" class="form-control row14" disabled></td>
                                    <td><input type="number" name="stock14" class="form-control row14" disabled></td>
                                    <td><input type="number" name="weight14" class="form-control row14" disabled></td>
                                    <td><input type="number" name="price14" class="form-control row14" disabled></td>
                                    <td><input type="number" name="discount14" class="form-control row14" disabled></td>
                                    <td>
                                        <select name="hsn14" class="form-control row14" disabled>
                                            <option value="">Select HSN</option>
                                            @foreach ($hsn as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gst14" class="form-control row14" disabled>
                                            <option value="">Select GST</option>
                                            @foreach ($gst as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- Summernote --}}

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
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
    @endpush
@endsection

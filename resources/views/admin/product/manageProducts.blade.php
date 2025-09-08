@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">
                <div>
                    <h5 class="card-header">Manage Listed Products </h5>
                    <span id="alert_msg" class="mx-6 mb-2 text-success">
                        @include('component.global-message')
                        @if (session('newProductAdded'))
                            <div class="alert alert-success">
                                {{ session('newProductAdded') }}
                            </div>
                        @endif
                        @if (session('productUpdated'))
                            <div class="alert alert-success">
                                {{ session('productUpdated') }}
                            </div>
                        @endif
                    </span>
                </div>
                <div class="mx-6">
                </div>
                <div class="card-body shadow p-3 bg-white rounded">
                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;"><a href="{{ route('add.product.page') }}"
                            class="link-light">Add new Product </a>
                    </button>
                  
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    {{-- <th>Parent Category</th> --}}
                                    <th>Product Type</th>
                                    <th>Article code</th>
                                    {{-- <th>MRP</th>
                                    <th>Discount</th>
                                    <th>Selling Price</th> --}}
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        {{-- <td>Product Name :
                                            @if ($data->status == 0)
                                                <span class="text-danger">{{ $data->name }}</span>
                                            @else
                                                <span class="text-success">{{ $data->name }}</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            Name :
                                            @if ($data->status == 0)
                                                <span class="text-danger">{{ $data->name }}</span>
                                            @else
                                                <span class="text-success">{{ $data->name }}</span>
                                            @endif
                                            {{-- Name: {{ $data->name }} --}}
                                            <br>
                                            {{-- @foreach ($images as $image) --}}
                                            {{-- <div>Thumbnail:
                                                @php
                                                    $firstImage = $images->firstWhere('product_id', $data->id);
                                                @endphp

                                                @if ($firstImage)
                                                    <img src="{{ asset('ProductThumbnail/' . $firstImage->name) }}"
                                                        width="50px" height="50px" alt="Thumbnail">
                                                @endif
                                            </div> --}}

                                            {{-- @endforeach --}}

                                            <div>Stock Count : {{ $data->stock }}</div>
                                            <div>Brand:
                                                @if ($data->brand == '')
                                                    --
                                                @else
                                                    @if ($data->brand == 1)
                                                        Nike
                                                    @elseif ($data->brand == 2)
                                                        Puma
                                                    @else
                                                        Adidas
                                                    @endif
                                                @endif
                                            </div>

                    </div>
                    </td>
                    {{-- <td>
                        @foreach ($productData as $product)
                            @foreach ($product->products_category as $category)
                                {{ $category->name }}
                            @endforeach                            
                        @endforeach
                    </td> --}}
                    <td>
                        @if ($data->productType == '')
                            --
                        @elseif ($data->productType == 1)
                            Shoes
                        @elseif ($data->productType == 2)
                            Clothes
                        @elseif ($data->productType == 3)
                            Accessories
                        @endif
                    </td>
                    
                    {{-- 
                    <td>{{ $data->actualPrice }}</td>
                    <td>{{ $data->discount }} % </td> --}}
                    {{-- <td>{{ $data->discountedPrice }}</td> --}}
                    <td>
                        @if ($data->articleCode == '')
                            --
                        @else
                            {{ $data->articleCode }}
                        @endif
                    </td>
                    <td>{{ $data->created_at->format('d/F/Y') }}</td>

                    @if ($data->status == '0')
                        <td>
                            <span class="text-danger text-dangers">InActive</span>
                        </td>
                    @else
                        <td>
                            <span class="text-success text-successs">Active</span>
                        </td>
                    @endif

                    <td>

                        <div class="d-flex gap-2 align-items-center">

                            <!-- Edit -->
                            <a href="{{ route('edit.product', $data->id) }}" class="btn border shadow-sm p-2"
                                style="background-color:rgb(252, 98, 41) !important;">
                                <i class="ti ti-edit text-light"></i>
                            </a>

                            <!-- Manage Variant -->
                            <a href="{{ route('manage.varient', $data->id) }}" class="btn border shadow-sm p-2"
                                style="background-color:rgb(252, 98, 41) !important;">
                                <i class="ti ti-affiliate text-light"></i>
                            </a>

                            <!-- Manage Images -->
                            <a href="{{ route('manage.variant.image', $data->id) }}" class="btn border shadow-sm p-2"
                                style="background-color:rgb(252, 98, 41) !important;">
                                <i class="ti ti-photo text-light"></i>
                            </a>

                            <!-- Delete -->
                            <a onclick="return confirm('Are you sure you want to delete this product ?')"
                                href="{{ route('delete.product', $data->id) }}" class="btn border shadow-sm p-2"
                                style="background-color:rgb(252, 98, 41) !important;">
                                <i class="ti ti-trash text-light"></i>
                            </a>

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
        <!-- DataTables CSS -->
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
                        searchPlaceholder: 'Search for products....' // Set your desired placeholder text here
                    },
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Check if the message exists in localStorage
                var message = localStorage.getItem('flash_message');

                if (message) {
                    // Display the message in the alert container
                    $('#alert_msg').html(`
            <div class="alert alert-success alert-dismissible" role="alert">
                ${message}
                
            </div>
        `);

                    setTimeout(function() {
                        localStorage.removeItem('flash_message');
                        $('#alert_msg').html('');
                        // window.location.reload();
                    }, 1500);
                }
            });
        </script>
    @endpush
@endsection

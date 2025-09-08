@extends('layouts.admin.app')

@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">

                <h5 class="card-header">Manage Product variants </h5>
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
                        {{-- <p style="margin-bottom: 4px;font-size: 15px;">Brand: 
                            @if ($productdata->brand == '')
                                -- N/A -- 
                            @else
                                {{ $productdata->brand  }}
                            @endif</p> --}}
                    </div>
                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;"><a
                            href="{{ route('add.varient', $productdata->id) }}" class="link-light">Add Product Variant</a>
                    </button>

                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>

                                    {{-- <th>id</th> --}}
                                    <th>Sku</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Stock</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Discount %</th>
                                    <th>Calculated discount</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($variantdata as $data)
                                    <tr>
                                        {{-- <td>{{$data->id}}</td> --}}
                                        <td>{{ $data->sku }}</td>
                                        {{-- <td class="d-flex align-items-center">
                                            <div
                                                style="width: 12px; height: 12px; background-color: {{ $data->color->colorCode }}; border-radius: 50%; margin-right: 8px;">
                                            </div>
                                            {{ $data->color->name }}
                                        </td> --}}
                                        <td class="d-flex align-items-center" data-order="{{ $data->color->name }}">
                                            <div
                                                style="width: 12px; height: 12px; background-color: {{ $data->color->colorCode }}; border-radius: 50%; margin-right: 8px;">
                                            </div>
                                            {{ $data->color->name }}
                                        </td>

                                        <td>
                                            {{ $data->size }}
                                        </td>
                                        <td>{{ $data->stock }} Units</td>
                                        <td>{{ $data->weight }} Gms.</td>
                                        <td>
                                            @if ($data->price == '')
                                                -- no price data --
                                            @else
                                                ₹. {{ $data->price }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->discount == '')
                                                -- no dicount data --
                                            @else
                                                {{ $data->discount }} %
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->discountedPrice == '')
                                                -- no dicountedPrice data --
                                            @else
                                                ₹. {{ $data->discountedPrice }}
                                            @endif
                                        </td>
                                        <td>{{ $data->created_at->format('d F Y') }}</td>

                                        <td>
                                            <button type="button" class=" btn btn-primary edit-btn" name="edit">
                                                <a href="{{ route('edit.varient', ['variant_id' => $data->id, 'product_id' => $productdata->id]) }}"
                                                    class=" link link-light">
                                                    Edit
                                                </a>
                                            </button>&nbsp;&nbsp;

                                            {{-- <button type="button" class=" btn btn-primary ">
                                                <a href="{{ route('delete.color', $data->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this?')"
                                                    class=" link link-light">
                                                    Delete
                                                </a>
                                            </button> --}}
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
            $('#product-table').DataTable({
                "pageLength": 10,
                "lengthChange": true,
                "ordering": true,
                "info": true,
                language: {
                    searchPlaceholder: 'Search by color....' ,
                },
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                        "orderable": false,
                        "targets": -1
                    }

                ]


            });
            
        </script>
    @endpush
@endsection

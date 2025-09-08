@extends('layouts.admin.app')

@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            {{-- {{ dd($orderData); }} --}}
            <div class="card mx-4 mt-6">
                <span id="alert_msg" class="text-success mt-6 mb-4 ">
                    {{-- @include('component.global-message') --}}
                    @if (session('hsnAdded'))
                        <div class="alert alert-success">
                            {{ session('hsnAdded') }}
                        </div>
                    @endif
                    @if (session('hsnUpdated'))
                        <div class="alert alert-success">
                            {{ session('hsnUpdated') }}
                        </div>
                    @endif
                </span>

                <h5 class="card-header">Order Listing</h5>
                <br>
                <br>
                <br>

                <div class="card-body shadow p-3 bg-white rounded">

                    <div class="table-responsive text-nowrap mt-3">
                        <table id="product-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th>Id</th> --}}
                                    <th>Order Id</th>
                                    <th>User ID</th>
                                    <th>TransactionID</th>
                                    <th>Delivering To</th>
                                    <th>Total Order Ammount</th>
                                    {{-- <th>Delivering status</th> --}}
                                    <th>Registered At</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderData as $data)
                                    <tr>


                                        <td>
                                            {{ $data->order_id }}
                                        </td>
                                        {{-- <td>
                                            {{ $data->id }}
                                        </td> --}}
                                        <td>
                                            @if ($data->user_id == null)
                                                "Guest"
                                            @else
                                                {{ $data->user_id }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data->txn_id }}
                                        </td>
                                        <td>
                                            {{ $data->name }}
                                        </td>
                                        <td>
                                            ₹: {{ $data->total }}
                                        </td>
                                        {{-- <td>
                                            <form action="{{ route('order.updateDeliveryStautus', $data->id) }}"
                                                method="POST">
                                                @csrf
                                                <select name="delivery_status"  class="form-select" id="deliveryStatus"  onchange="this.form.submit()">
                                                    <option value="Pending"
                                                        {{ $data->delivery_status === 'Pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="Not Delivered"
                                                        {{ $data->delivery_status === 'Not Delivered' ? 'selected' : '' }}>Not
                                                        Delivered</option>
                                                    <option value="Delivered"
                                                        {{ $data->delivery_status === 'Delivered' ? 'selected' : '' }}>
                                                        Delivered</option>
                                                    <option value="Returned"
                                                        {{ $data->delivery_status === 'Returned' ? 'selected' : '' }}>
                                                        Returned</option>
                                                    <option value="Cancelled"
                                                        {{ $data->delivery_status === 'Cancelled' ? 'selected' : '' }}>
                                                        Cancelled</option>

                                                </select>
                                            </form>
                                        </td> --}}
                                        <td>
                                            {{ $data->created_at }}
                                        </td>
                                        <td>
                                            <a type="button" href="{{ route('order.details',$data->id) }}" class=" btn btn-light edit-btn"
                                                name="edit ">View</a>
                                        </td>
                                        {{-- @endforeach
                                {{-- <tr>
                                    <td>1</td>
                                    <td>order details</td>
                                    <td>order details</td>
                                    <td>order details</td>
                                    <td>order details</td>
                                </tr> --}}
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
                        searchPlaceholder: 'Search by order id...'// Set your desired placeholder text here
                    },
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                });
            });
        </script>
    @endpush
@endsection

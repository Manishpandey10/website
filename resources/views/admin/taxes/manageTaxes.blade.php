@extends('layouts.admin.app')

@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">

                <h5 class="card-header">Manage Tags </h5>
                <span id="alert_msg" class="text-success mt-6 mb-4 ">
                    {{-- @include('component.global-message') --}}
                    @if (session('taxAdded'))
                        <div class="alert alert-success">
                            {{ session('taxAdded') }}
                        </div>
                    @endif
                    @if (session('taxUpdated'))
                        <div class="alert alert-success">
                            {{ session('taxUpdated') }}
                        </div>
                    @endif
                </span>

                <div class="mt-6">
                </div>
                <div class="card-body shadow p-3 bg-white rounded">

                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;"><a href="{{ route('add.tax.slab') }}"
                            class="link-light">Add New GST Tax slab</a>
                    </button>

                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>
                                    <th>GST Slab Rate Code</th>
                                    <th>Min Tax Rate</th>
                                    <th>Max Tax Rate</th>
                                    <th>Product price limit</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($taxData as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @if ($data->minTax == 1)
                                                0%
                                            @elseif($data->minTax == 2)
                                                3%
                                            @elseif($data->minTax == 3)
                                                5%
                                            @elseif($data->minTax == 4)
                                                6%
                                            @elseif($data->minTax == 5)
                                                12%
                                            @elseif($data->minTax == 6)
                                                18%
                                            @elseif($data->minTax == 7)
                                                28%
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>
                                            @if ($data->maxTax == 1)
                                                0%
                                            @elseif($data->maxTax == 2)
                                                3%
                                            @elseif($data->maxTax == 3)
                                                5%
                                            @elseif($data->maxTax == 4)
                                                6%
                                            @elseif($data->maxTax == 5)
                                                12%
                                            @elseif($data->maxTax == 6)
                                                18%
                                            @elseif($data->maxTax == 7)
                                                28%
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td> ₹.{{ $data->pricelimit }} </td>

                                        <td>{{ $data->created_at->format('d/F/Y') }}</td>

                                        <td>
                                            <button type="button" class=" btn btn-primary edit-btn" name="edit">
                                                <a href="{{ route('edit.tax.slab', $data->id) }}" class=" link link-light">
                                                    Edit
                                                </a>
                                            </button>&nbsp;&nbsp;


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
                    searchPlaceholder: 'Search for tax slab....' // Set your desired placeholder text here
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

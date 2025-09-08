@extends('layouts.admin.app')

@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">

                <h5 class="card-header">Manage Product types </h5>
                <span id="alert_msg" class="text-success mt-6 mb-4 ">
                    @if (session('typeAdded'))
                        <div class="alert alert-success">
                            {{ session('typeAdded') }}
                        </div>
                    @endif
                    @if (session('typeUpdated'))
                        <div class="alert alert-success">
                            {{ session('typeUpdated') }}
                        </div>
                    @endif
                </span>
                {{--  --}}

                <div class="mt-6">
                </div>
                <div class="card-body shadow p-3 bg-white rounded">

                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;"><a href="{{ route('add.types') }}"
                            class="link-light">Add new product type</a>
                    </button>

                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product type Name</th>
                                    <th>Sizes</th>
                                    <th>Registered At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($typeData as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->size }}</td>
                                        <td>{{ $data->created_at->format('d/F/Y') }}</td>

                                        <td>
                                            <button type="button" class=" btn btn-primary edit-btn" name="edit">
                                                <a href="{{ route('edit.types', $data->id) }}"" class=" link link-light">
                                                    Edit
                                                </a>
                                            </button>&nbsp;&nbsp;

                                            <button type="button" class=" btn btn-primary ">
                                                <a href="{{ route('delete.types', $data->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this?')"
                                                    class=" link link-light">
                                                    Delete
                                                </a>
                                            </button>
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
                    searchPlaceholder: 'Search for product types....' // Set your desired placeholder text here
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

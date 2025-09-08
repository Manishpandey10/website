@extends('layouts.admin.app')
@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">

                <h5 class="card-header">Manage Product Category </h5>
                <span id="alert_msg" class="text-success mt-6 mb-4 ">
                    {{-- @include('component.global-message') --}}
                    @if (session('newCategory'))
                        <div class="alert alert-success">
                            {{ session('newCategory') }}
                        </div>
                    @endif
                    @if (session('categoryUpdated'))
                        <div class="alert alert-success">
                            {{ session('categoryUpdated') }}
                        </div>
                    @endif
                </span>

                <div class="mt-6">
                </div>
                <div class="card-body shadow p-3 bg-white rounded">

                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;"><a href="{{ route('add.category.page') }}"
                            class="link-light">Add new Product category</a>
                    </button>

                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>

                                    <th>Category Name</th>
                                    {{-- <th>Category Image</th> --}}
                                    <th>Parent Category</th>
                                    <th>Registered At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categoryData as $data)
                                    <tr>

                                        <td>{{ $data->name }}</td>
                                        {{-- <td>
                                            <img src="{{ url('storage/' . $data->category_image) }}" width="85px"
                                                height="80px" border-radius:50%>
                                        </td> --}}
                                        <td>
                                            @if ($data->parents == null )
                                                -- is a parent --
                                            @else
                                                {{ $data->parents->name }}
                                            @endif
                                        </td>
                                        <td>{{ $data->created_at }}</td>
                                        @if ($data->status == '0')
                                            <td>
                                                <span class="text-danger text-dangers">InActive</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="text-success text-success">Active </span>
                                            </td>
                                        @endif
                                        <td>
                                            <button type="button" class=" btn btn-primary edit-btn" name="edit">
                                                <a href="{{ route('edit.category', $data->id) }}"" class=" link link-light">
                                                    Edit
                                                </a>
                                            </button>&nbsp;&nbsp;

                                            <button type="button" class=" btn btn-primary ">
                                                <a href="{{ route('delete.category', $data->id) }}"
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
                    searchPlaceholder: 'Search for category....' // Set your desired placeholder text here
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
                ${message}</div> `);

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

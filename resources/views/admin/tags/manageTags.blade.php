@extends('layouts.admin.app')

@section('main-container')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card mx-4 mt-6">

                <h5 class="card-header">Manage Tags </h5>
                <span id="alert_msg" class="text-success mt-6 mb-4 ">
                    {{-- @include('component.global-message') --}}
                    @if (session('TagAdded'))
                        <div class="alert alert-success">
                            {{ session('TagAdded') }}
                        </div>
                    @endif
                    @if (session('TagUpdated'))
                        <div class="alert alert-success">
                            {{ session('TagUpdated') }}
                        </div>
                    @endif
                </span>

                <div class="mt-6">
                </div>
                <div class="card-body shadow p-3 bg-white rounded">

                    <button type="button" class=" btn btn-light " id="edit" name="edit"
                        style="background-color:rgb(252, 98, 41) !important;"><a href="{{ route('add.tags') }}"
                            class="link-light">Add Tags</a>
                    </button>

                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tagData as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                                <span class="text-danger">InActive</span>
                                            @else
                                                <span class="text-success">Active</span>
                                            @endif

                                        </td>

                                        <td>{{ $data->created_at->format('d F Y') }}</td>

                                        <td>
                                            <button type="button" class=" btn btn-primary edit-btn" name="edit">
                                                <a href="{{ route('edit.tags', $data->id) }}" class=" link link-light">
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
                    searchPlaceholder: 'Search for tags....' // Set your desired placeholder text here
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

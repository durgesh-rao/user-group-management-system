@extends('layouts.admin')

@section('title')
    Users
@endsection

@section('content')
    <div class="card">

        <div class="card-header">
            <a class="btn btn-sm btn-success float-right p-2 ml-2 add" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Add User
            </a>
            <a class="btn btn-sm btn-primary float-right p-2 trash" href="{{ route('users.trash') }}">
                <i class="fa fa-trash"></i> Go To Trash
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Users List</h5>
                <span class="badge bg-primary">{{ $users->count() }} Records</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="80" class="text-center">ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Group</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td><strong>{{ $user->label }}</strong></td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $usersWithGroupNames[$user->id] }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                                class="d-inline ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No Users Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        $("#data-table").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "searching": true,
            "ordering": true,
            "info": false,
        });

        $('.delete-btn').click(function(evt) {
            if (!confirm('Do you want to delete this user')) {
                evt.preventDefault()
            }
        })
    </script>
@endsection

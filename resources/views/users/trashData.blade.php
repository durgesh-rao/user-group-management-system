@extends('layouts.admin')

@section('title')
Trash Users
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-info float-right">
            <i class="fa fa-upload"></i> Add User
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="data-table" class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Mobile</th>
                        <th>Group</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->label }}</td>
                        <td>{{ $user->mobile}}</td>
                        <td>{{ $usersWithGroupNames[$user->id] }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('users.restore', $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-restore"></i>Restore</a>
                                <form action="{{ route('users.delete', $user->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="delete-btn btn btn-sm btn-danger"><i class="fa fa-trash-restore"></i>Trash</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
    "ordering": false,
    "info": false,
}).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');

$('.delete-btn').click(function(evt){
    if(!confirm('Do you want to delete this user'))
    {
        evt.preventDefault()
    }
})
</script>

@endsection

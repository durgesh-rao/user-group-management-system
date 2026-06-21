@extends('layouts.admin')
@section('title')
Groups
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="card">
    <div class="card-header">
        <a class="btn btn-sm btn-info float-right" href="{{ route('group.create')}}">
            <i class="fa fa-upload"></i> Add Group
        </a>
    </div>

<!-- table view produts  -->

    <div class="card-body">
        <div class="table-responsive">
            <table id="data-table" class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->label }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('group.restore', $group->id) }}" class="btn btn-sm btn-default">Restore</i></a>
                                <form action="{{ route('group.destroy', $group->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="delete-btn btn btn-sm btn-default">Trash</button>
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
    $('#brandss').select2({
        dropdownParent: $('#product-details')
    });
</script>

<script>
    $('#category').select2({
        dropdownParent: $('#product-details')
    });
</script>






<script>
    $("#data-table").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "paging": false,
        "searching": true,
        "ordering": true,
        "info": false,
    }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');

    $('.delete-btn').click(function(evt) {
        if (!confirm('Do you want to Trashed this Product')) {
            evt.preventDefault()
        }
    })
</script>



<!-- validation for add form -->
<script>
    function validateProductForm(el) {
        var pname = $('#productName').val();
        var files = $('#image')[0].files;
        var productfile = $('#productimage')[0].files;
        var brand = $('#brandss').val();
        var category = $('#category').val();
        var subcategory = $('#subcatshow').val();
        var form =$('#formType').val()
        var volume = $('#measurment-show').val()
        var volumevalue = $('#volume_value').val();
        var description= $('#description').val()
        var price = $('#price').val();
        alert(brand)
        if (pname='')
        {
            $('#productErr').html('Product Name Required !');
            el.preventDefault();
            return false;
        }
        if (files.length!=0)
        {
            if (files[0].type != 'image/jpeg' && files[0].type != 'image/png') {
                Swal.fire({
                    icon: 'error',
                    text: "Product Image must be image",
                })
                evt.preventDefault();
                return false;
            }
            return false;
        }
        else
        {
            $('#imageErr').html('Image Required');
            return false;
        }
        if(brand='')
        {
            Swal.fire({
                icon: 'error',
                text: 'Brand Name Required',
            });
            el.preventDefault();
            return false;
        }
        if(category='')
        {
            Swal.fire({
                icon: 'error',
                text: 'Category Name required',
            })
            return false;
        }
        if('')
        if (!productfile.length == 0) {
            for (var i=0; i<productfile.length; i++) {
                if (files[i].type != 'image/jpeg' && files[i].type != 'image/png') {
                    Swal.fire({
                        icon: 'error',
                        text: "Product Image must be image",
                    })
                    evt.preventDefault();
                    return false;
                }
            }
        }
        else{
            $('#multiimageErr').html('image required');
        }
        el.preventDefault()
        return false;
    }
</script>
@endsection

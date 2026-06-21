@extends('layouts.admin')

@php
$route= Route::currentRouteName()
@endphp

@section('title')
{{ $route=='group.create' ? 'Add Group' : 'Edit Group' }}
@endsection

@section('content')

<form id="groupForm" action="{{ $route == 'group.create' ? url('group/store') : url('group/update', $group->id) }}" method="post">
    {{ $route=='group.create' ? method_field('POST') : method_field('PUT') }}
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" id="group" name="label" value="{{ @$group->label}}">
                        <span class="text-danger" style="font-size: 14px;" id="label"></span>
                    </div>
                    <span class="text-danger err" id="label"></span>
                    <div class="card-footer">
                        <button type="submit" id="submit_btn" class="btn btn-success">{{ $route== 'group.create' ? 'save' : 'update'}}</button>
                        <a href="{{ route('group.index') }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>  

$('#groupForm').submit(function(event){
    event.preventDefault();

    var data = $(this).serialize();
    $('.err').text(''); 
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: data,
        dataType: 'JSON', 
        success: function(response) {
        alert(response.msg)
            if (response.status == 1) {
                window.location.href = "/group"
                }
            },
        error: function(response) {
            var errors = response.responseJSON.errors;
            for (key in errors) {
                var msg = errors[key][0];
                $('#' + key).text(msg)
            }
        }
    })
    
})
</script>
@endsection

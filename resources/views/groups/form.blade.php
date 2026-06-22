@extends('layouts.admin')

@php
    $route = Route::currentRouteName();
@endphp

@section('title')
    {{ $route == 'group.create' ? 'Add Group' : 'Edit Group' }}
@endsection

@section('content')
    <form id="groupForm" action="{{ $route == 'group.create' ? url('group/store') : url('group/update', $group->id) }}"
        method="post">
        @if ($route != 'group.create')
            @method('PUT')
        @endif
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" class="form-control" id="group" name="label"
                                value="{{ @$group->label }}">
                        </div>
                        <span class="text-danger err" id="label"></span>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="submit_btn"
                            class="btn btn-success">{{ $route == 'group.create' ? 'save' : 'update' }}</button>
                        <a href="{{ route('group.index') }}" class="btn btn-info">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </form>


    <script>
        $('#groupForm').submit(function(event) {
            event.preventDefault();

            let submitBtn = $('#submit_btn');
            submitBtn.prop('disabled', true).text('Saving...');

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
                    } else {
                        submitBtn.prop('disabled', false).text('{{ $route == 'group.create' ? 'Save' : 'Update' }}');
                    }
                },
                error: function(response) {
                    submitBtn.prop('disabled', false).text('{{ $route == 'group.create' ? 'Save' : 'Update' }}');

                    var errors = response.responseJSON.errors;
                    for (let key in errors) {
                        $('#' + key).text(errors[key][0]);
                    }
                }
            })

        })
    </script>
@endsection

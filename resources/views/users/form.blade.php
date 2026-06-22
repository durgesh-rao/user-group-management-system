@extends('layouts.admin')

@php
    $route = Route::currentRouteName();
@endphp

@section('title')
    {{ $route == 'users.create' ? 'Add User' : 'Edit User' }}
@endsection


@section('content')
    <style>
        .select2-selection__choice__display {
            color: black !important;
        }
    </style>


    <form id="form" action="{{ $route == 'users.create' ? url('users/store') : url('users/update', $user->id) }}"
        method="POST">
        @if ($route != 'users.create')
            @method('PUT')
        @endif

        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" class="form-control" name="label" value="{{ @$user->label }}">
                            <span id="label" class="err text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="mobileId" maxlength="10"
                                value="{{ @$user->mobile }}">
                            <span id="mobile" class="err text-danger"></span>
                        </div>
                        <div class="">
                            <label>Groups</label>
                            <select class="form-control select2" name="groups[]" multiple>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" @if (optional(@$user->groups)->contains($group->id)) selected @endif>
                                        {{ $group->label }}</option>
                                @endforeach
                            </select>

                            <span id="groups" class="err text-danger"></span>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="submit_btn" class="btn btn-success">
                            {{ $route == 'users.create' ? 'Save' : 'Update' }}
                        </button>

                        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <script type="text/javascript">
        $('#form').submit(function(event) {
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Your Form Succesfully Submitted',
                            showDenyButton: true,
                            confirmButtonText: 'Continue',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/users"
                            } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                            }
                        })
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

        $('#mobileId').on('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Groups",
                allowClear: true
            });
        });
    </script>
@endsection

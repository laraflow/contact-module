@extends('core::layouts.app')

@section('title', $user->name ?? 'Details')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('modules/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('page-style')

@endpush



@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $user))


@section('actions')
    {!! \Html::backButton('core.settings.users.index') !!}
    @module('Rbac')
    @can('core.settings.roles.user')
        <a href="#!" data-toggle="modal" data-target="#bd-example-modal-lg"
           class="btn btn-primary m-1 m-md-0">
            <i class="mdi mdi-account-convert-outline"></i>
            <span class="d-none d-md-inline-flex">Add / Remove Roles</span>
        </a>
    @endcan
    @endmodule
    {!! \Html::modelDropdown('core.settings.users', $user->id, ['color' => 'success',
    'actions' => array_merge(['edit'], ($user->deleted_at == null) ? ['delete'] : ['restore'])]) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('core::setting.user.partials.user-card', $user)
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-3">
                        <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab"
                                   data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true"><strong>Details</strong></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pills-permission-tab"
                                   data-toggle="pill" href="#pills-permission"
                                   role="tab" aria-controls="pills-permission"
                                   aria-selected="false"><strong>Permissions</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab"
                                   data-toggle="pill" href="#pills-timeline"
                                   role="tab" aria-controls="pills-timeline"
                                   aria-selected="false"><strong>Timeline</strong></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="d-block">Name</label>
                                        <p class="fw-bolder">{{ $user->name ?? null }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-block">Guard(s)</label>
                                        <p class="fw-bolder">{{ $user->guard_name ?? null }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-block">Enabled</label>
                                        <p class="fw-bolder">{{ \Modules\Core\Supports\Constant::ENABLED_OPTIONS[$user->enabled] ?? null }}</p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label class="d-block">Remarks</label>
                                        <p class="fw-bolder">{{ $user->remarks ?? null }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-permission" role="tabpanel"
                                 aria-labelledby="pills-permission-tab">
                                <div class="accordion" id="accordionExample">
                                    @forelse($user->roles as $role)
                                        <div class="card">
                                            <h4 class="card-header mb-0 px-1 py-2" id="heading{{ $role->id }}"
                                                data-toggle="collapse" data-target="#collapse{{ $role->id }}"
                                                aria-expanded="true" aria-controls="collapse{{ $role->id }}">
                                                <i class="fa fa-user-check"></i>
                                                {{ $role->name }}
                                            </h4>
                                            <div id="collapse{{ $role->id }}" class="collapse"
                                                 aria-labelledby="heading{{ $role->id }}"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @forelse($role->permissions as $permission)
                                                            <div class="col-md-6">
                                                                <p class="text-dark fw-bold"
                                                                   title="{{ $permission->name }}">
                                                                    <i class="mdi mdi-account-key m-2"></i> {{ $permission->display_name }}
                                                                </p>
                                                            </div>
                                                        @empty
                                                            <div class="col-12 text-center fw-bolder">This Role Don't
                                                                have any
                                                                Permission/Privileges
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center font-weight-bolder">
                                            This user don't have any role(s) assigned.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-timeline" role="tabpanel"
                                 aria-labelledby="pills-timeline-tab">
                                @include('core::layouts.partials.timeline', $timeline)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="modal fade" id="bd-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! \Form::open(['route' => ['core.settings.roles.user', $role->id], 'method' => 'put', 'id' => 'role-user-form']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Available Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: scroll;">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="mdi mdi-magnify"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" onkeyup="searchFilter(this.value, 'role-table');"
                                               placeholder="Search Permission Name" id="search" type="search">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-hover table-sm mb-0" id="role-table">
                                    <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="35" class="p-2 align-middle">
                                            <div class="icheck-primary">
                                                {!! Form::checkbox('test', 1,false, ['id' => 'role_all']) !!}
                                                <label for="role_all"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle">Permission</th>
                                        <th class="align-middle">Enabled</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($roles as $role)
                                        <tr class="@if($role->enabled == \Modules\Core\Supports\Constant::ENABLED_OPTION) table-success @else table-danger @endif">
                                            <td class="p-2 text-center align-middle">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('roles[]', $role->id,
                                                        in_array($role->id, $availablePermissionIds),
                                                         ['id' => 'role_' . $role->id, 'class' => 'role-checkbox']) !!}
                                                    <label for="{{ 'role_' . $role->id }}"></label>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $role->display_name }}</td>
                                            <td class="align-middle text-center">{{ \Modules\Core\Supports\Constant::ENABLED_OPTIONS[$role->enabled] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center font-weight-bolder">
                                                No Permission/Privileges Available
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                {!! \Form::close(); !!}
            </div>
        </div>
    </div>--}}
    {!! \Modules\Core\Supports\CHTML::confirmModal('User', ['export', 'delete', 'restore']) !!}

@endsection

@push('plugin-script')

@endpush


@push('page-script')
    <script>
        $(function () {
            $.ajax({
                url: '{{ route('core.settings.roles.ajax') }}',
                data: {paginate: false},
                contentType: 'application/json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                dataType: 'json',
                success: function (response) {

                },
                error: function (response) {

                }
            });

            $("#role_all").click(function () {
                if ($(this).prop("checked")) {
                    $(".role-checkbox").each(function () {
                        $(this).prop("checked", true);
                    });
                } else {
                    $(".role-checkbox").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("#role-user-form").submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                var formUrl = $(this).attr('action');

                $.ajax({
                    url: formUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    dateType: "JSON",
                    success: function (response) {
                        if (response.status === true) {
                            notify(response.message, response.level, response.title);
                            setTimeout(function () {
                                window.location.reload();
                            }, 5000);

                        } else {
                            notify(response.message, response.level, response.title);
                        }
                    },
                    error: function (error) {
                        var responseObject = error.responseJSON;

                        var message = responseObject.message;

                        for (var field in responseObject.errors) {
                            message += "<br><ul>";
                            for (var errorText of responseObject.errors[field]) {
                                message += ("<li>" + errorText + "</li>");
                            }
                            message += "</ul>";
                        }

                        notify(message, 'error', 'Error!');
                    }
                });
            });

        });
    </script>
@endpush

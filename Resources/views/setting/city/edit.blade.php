@extends('core::layouts.app')

@section('title', 'Add Role')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $role))

@section('actions')
    {!! \Html::backButton('core.settings.roles.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! \Form::open(['route' => ['core.settings.roles.update', $role->id], 'method' => 'put', 'id' => 'role-form']) !!}
               @include('core::setting.role.form')
                {!! \Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-scripts')
@endpush

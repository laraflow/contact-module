@extends('core::layouts.app')

@section('title', 'Edit Setting')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')

@endpush

@push('inline-style')

@endpush


@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName(), $permission))

@section('actions')
    {!! \Html::backButton('core.settings.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! \Form::open(['route' => ['core.settings.update', $permission->id], 'method' => 'put', 'id' => 'permission-form']) !!}
                @include('core::setting.form')
                {!! \Form::close() !!}
            </div>
        </div>
    </div>
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

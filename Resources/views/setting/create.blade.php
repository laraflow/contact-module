@extends('core::layouts.app')

@section('title', 'Add Setting')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')

@endpush

@push('page-style')

@endpush


@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName()))

@section('actions')
    {!! \Html::backButton('core.settings.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! \Form::open(['route' => 'core.settings.store', 'id' => 'setting-form']) !!}
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

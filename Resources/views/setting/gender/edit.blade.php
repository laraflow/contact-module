@extends('core::layouts.app')

@section('title', 'Edit Gender')

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

@push('head-script')

@endpush



@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName(), $gender))

@section('actions')
    {!! \Html::backButton('contact.settings.genders.index') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {!! \Form::open(['route' => ['contact.settings.genders.update', $gender->id], 'method' => 'put', 'id' => 'gender-form']) !!}
                    @include('contact::setting.gender.form')
                    {!! \Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

@extends('core::layouts.app')

@section('title', 'Edit Religions')

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



@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName(), $religion))

@section('actions')
    {!! \Html::backButton('contact.settings.religions.index') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {!! \Form::open(['route' => ['contact.settings.religions.update', $religion->id], 'method' => 'put', 'id' => 'religion-form']) !!}
                    @include('contact::setting.religion.form')
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

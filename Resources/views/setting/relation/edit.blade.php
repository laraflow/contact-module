@extends('core::layouts.app')

@section('title', 'Edit Relations')

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



@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName(), $relation))

@section('actions')
    {!! \Html::backButton('contact.settings.relations.index') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {!! \Form::open(['route' => ['contact.settings.relations.update', $relation->id], 'method' => 'put', 'id' => 'relation-form']) !!}
                    @include('contact::setting.relation.form')
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

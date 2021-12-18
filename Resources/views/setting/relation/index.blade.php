@extends('core::layouts.app')

@section('title', 'Relations')

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


@section('breadcrumbs', \Breadcrumbs::render())

@section('actions')
    {!! \Html::linkButton('Add Relations', 'contact.settings.relations.create', [], 'mdi mdi-plus', 'success') !!}
    {!! \Html::bulkDropdown('contact.settings.relations', 0, ['color' => 'warning']) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    @if(!empty($relations))
                        <div class="card-body p-0">
                            {!! \Html::cardSearch('search', 'contact.settings.relations.index',
                            ['placeholder' => 'Search Relations Display Name, Code, Guard, Status, etc.',
                            'class' => 'form-control', 'id' => 'search', 'data-target-table' => 'permission-table']) !!}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="permission-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="align-middle">@sortablelink('id', '#')</th>
                                        <th>@sortablelink('name', 'Name')</th>
                                        <th>@sortablelink('remarks', 'Remarks')</th>
                                        <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                                        <th class="text-center">@sortablelink('created_at', 'Created')</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($relations as $index => $relation)
                                        <tr @if($relation->deleted_at != null) class="table-danger" @endif>
                                            <td class="exclude-search align-middle">
                                                {{ $relation->id }}
                                            </td>
                                            <td class="text-left">
                                                @can('contact.settings.relations.show')
                                                    <a href="{{ route('contact.settings.relations.show', $relation->id) }}">
                                                        {{ $relation->name }}
                                                    </a>
                                                @else
                                                    {{ $relation->name }}
                                                @endcan
                                            </td>
                                            <td>{{ $relation->remarks }}</td>
                                            <td class="text-center exclude-search">
                                                {!! \Html::enableToggle($relation) !!}
                                            </td>
                                            <td class="text-center">{{ $relation->created_at->format(config('app.datetime')) ?? '' }}</td>
                                            <td class="exclude-search pr-3 text-center align-middle">
                                                {!! \Html::actionDropdown('contact.settings.relations', $relation->id, array_merge(['show', 'edit'], ($relation->deleted_at == null) ? ['delete'] : ['restore'])) !!}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="exclude-search text-center">No data to display</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent pb-0">
                            {!! \Modules\Core\Supports\CHTML::pagination($relations) !!}
                        </div>
                    @else
                        <div class="card-body min-vh-100">

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    {!! \Modules\Core\Supports\CHTML::confirmModal('Relations', ['export', 'delete', 'restore']) !!}
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

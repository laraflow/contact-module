@extends('core::layouts.app')

@section('title', 'Labels')

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
    {!! \Html::linkButton('Add Label', 'core.settings.labels.create', [], 'mdi mdi-plus', 'success') !!}
    {!! \Html::bulkDropdown('core.settings.labels', 0, ['color' => 'warning']) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    @if(!empty($labels))
                        <div class="card-body p-0">
                            {!! \Html::cardSearch('search', 'core.settings.labels.index',
                            ['placeholder' => 'Search Label Name etc.',
                            'class' => 'form-control', 'id' => 'search', 'data-target-table' => 'label-table']) !!}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="label-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="align-middle">
                                            @sortablelink('id', '#')
                                        </th>
                                        <th>@sortablelink('name', 'Name')</th>
                                        <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                                        <th class="text-center">@sortablelink('created_at', 'Created')</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($labels as $index => $label)
                                        <tr @if($label->deleted_at != null) class="table-danger" @endif>
                                            <td class="exclude-search align-middle">
                                                {{ $label->id }}
                                            </td>
                                            <td class="text-left">
                                                @can('core.settings.labels.show')
                                                    <a href="{{ route('core.settings.labels.show', $label->id) }}">
                                                        {{ $label->name }}
                                                    </a>
                                                @else
                                                    {{ $label->name }}
                                                @endcan
                                            </td>
                                            <td class="text-center exclude-search">
                                                {!! \Html::enableToggle($label) !!}
                                            </td>
                                            <td class="text-center">{{ $label->created_at->format(config('app.datetime')) ?? '' }}</td>
                                            <td class="exclude-search pr-3 text-center align-middle">
                                                {!! \Html::actionDropdown('core.settings.labels', $label->id, array_merge(['show', 'edit'], ($label->deleted_at == null) ? ['delete'] : ['restore'])) !!}
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
                            {!! \Modules\Core\Supports\CHTML::pagination($labels) !!}
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
    {!! \Modules\Core\Supports\CHTML::confirmModal('Label', ['export', 'delete', 'restore']) !!}
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

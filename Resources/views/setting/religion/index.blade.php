@extends('core::layouts.app')

@section('title', 'Religions')

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
    {!! \Html::linkButton('Add Religions', 'contact.settings.religions.create', [], 'mdi mdi-plus', 'success') !!}
    {!! \Html::bulkDropdown('contact.settings.religions', 0, ['color' => 'warning']) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    @if(!empty($religions))
                        <div class="card-body p-0">
                            {!! \Html::cardSearch('search', 'contact.settings.religions.index',
                            ['placeholder' => 'Search Religions Display Name, Code, Guard, Status, etc.',
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
                                    @forelse($religions as $index => $religion)
                                        <tr @if($religion->deleted_at != null) class="table-danger" @endif>
                                            <td class="exclude-search align-middle">
                                                {{ $religion->id }}
                                            </td>
                                            <td class="text-left">
                                                @can('contact.settings.religions.show')
                                                    <a href="{{ route('contact.settings.religions.show', $religion->id) }}">
                                                        {{ $religion->name }}
                                                    </a>
                                                @else
                                                    {{ $religion->name }}
                                                @endcan
                                            </td>
                                            <td>{{ $religion->remarks }}</td>
                                            <td class="text-center exclude-search">
                                                {!! \Html::enableToggle($religion) !!}
                                            </td>
                                            <td class="text-center">{{ $religion->created_at->format(config('app.datetime')) ?? '' }}</td>
                                            <td class="exclude-search pr-3 text-center align-middle">
                                                {!! \Html::actionDropdown('contact.settings.religions', $religion->id, array_merge(['show', 'edit'], ($religion->deleted_at == null) ? ['delete'] : ['restore'])) !!}
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
                            {!! \Modules\Core\Supports\CHTML::pagination($religions) !!}
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
    {!! \Modules\Core\Supports\CHTML::confirmModal('Religions', ['export', 'delete', 'restore']) !!}
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

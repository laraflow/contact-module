@extends('core::layouts.app')

@section('title', 'Blood Groups')

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
    {!! \Html::linkButton('Add Blood Group', 'contact.settings.blood-groups.create', [], 'mdi mdi-plus', 'success') !!}
    {!! \Html::bulkDropdown('contact.settings.blood-groups', 0, ['color' => 'warning']) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    @if(!empty($bloodGroups))
                        <div class="card-body p-0">
                            {!! \Html::cardSearch('search', 'contact.settings.blood-groups.index',
                            ['placeholder' => 'Search Blood Group Display Name, Code, Guard, Status, etc.',
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
                                    @forelse($bloodGroups as $index => $bloodGroup)
                                        <tr @if($bloodGroup->deleted_at != null) class="table-danger" @endif>
                                            <td class="exclude-search align-middle">
                                                {{ $bloodGroup->id }}
                                            </td>
                                            <td class="text-left">
                                                @can('contact.settings.blood-groups.show')
                                                    <a href="{{ route('contact.settings.blood-groups.show', $bloodGroup->id) }}">
                                                        {{ $bloodGroup->name }}
                                                    </a>
                                                @else
                                                    {{ $bloodGroup->name }}
                                                @endcan
                                            </td>
                                            <td>{{ $bloodGroup->remarks }}</td>
                                            <td class="text-center exclude-search">
                                                {!! \Html::enableToggle($bloodGroup) !!}
                                            </td>
                                            <td class="text-center">{{ $bloodGroup->created_at->format(config('app.datetime')) ?? '' }}</td>
                                            <td class="exclude-search pr-3 text-center align-middle">
                                                {!! \Html::actionDropdown('contact.settings.blood-groups', $bloodGroup->id, array_merge(['show', 'edit'], ($bloodGroup->deleted_at == null) ? ['delete'] : ['restore'])) !!}
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
                            {!! \Modules\Core\Supports\CHTML::pagination($bloodGroups) !!}
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
    {!! \Modules\Core\Supports\CHTML::confirmModal('Blood Group', ['export', 'delete', 'restore']) !!}
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

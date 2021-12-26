@extends('core::layouts.app')

@section('title', 'Contacts')

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
    {!! \Html::linkButton('Add Contact', 'core.settings.contacts.create', [], 'mdi mdi-plus', 'success') !!}
    {!! \Html::bulkDropdown('core.settings.contacts', 0, ['color' => 'warning']) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    @if(!empty($contacts))
                        <div class="card-body p-0">
                            {!! \Html::cardSearch('search', 'core.settings.contacts.index',
                            ['placeholder' => 'Search Contact Name etc.',
                            'class' => 'form-control', 'id' => 'search', 'data-target-table' => 'contact-table']) !!}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="contact-table">
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
                                    @forelse($contacts as $index => $contact)
                                        <tr @if($contact->deleted_at != null) class="table-danger" @endif>
                                            <td class="exclude-search align-middle">
                                                {{ $contact->id }}
                                            </td>
                                            <td class="text-left">
                                                @can('core.settings.contacts.show')
                                                    <a href="{{ route('core.settings.contacts.show', $contact->id) }}">
                                                        {{ $contact->name }}
                                                    </a>
                                                @else
                                                    {{ $contact->name }}
                                                @endcan
                                            </td>
                                            <td class="text-center exclude-search">
                                                {!! \Html::enableToggle($contact) !!}
                                            </td>
                                            <td class="text-center">{{ $contact->created_at->format(config('app.datetime')) ?? '' }}</td>
                                            <td class="exclude-search pr-3 text-center align-middle">
                                                {!! \Html::actionDropdown('core.settings.contacts', $contact->id, array_merge(['show', 'edit'], ($contact->deleted_at == null) ? ['delete'] : ['restore'])) !!}
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
                            {!! \Modules\Core\Supports\CHTML::pagination($contacts) !!}
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
    {!! \Modules\Core\Supports\CHTML::confirmModal('Contact', ['export', 'delete', 'restore']) !!}
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

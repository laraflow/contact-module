@extends('core::layouts.app')

@section('title', 'Users')

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
    {!! \Html::linkButton('Add User', 'core.settings.users.create', [], 'mdi mdi-plus', 'success') !!}
    {!! \Html::bulkDropdown('core.settings.users', 0, ['color' => 'warning']) !!}

@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            @if(!empty($users))
                <div class="card-body p-0">
                    {!! \Html::cardSearch('search', 'core.settings.users.index',
['placeholder' => 'Search Role Name, Code, Guard, Status, etc.',
'class' => 'form-control', 'id' => 'search', 'data-target-table' => 'user-table']) !!}
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="user-table">
                            <thead class="thead-light">
                            <tr>
                                <th class="align-middle">
                                    @sortablelink('id', '#')
                                </th>
                                <th class="pl-0">@sortablelink('name', 'Name')</th>
                                <th class="text-center">@sortablelink('email', 'Email')</th>
                                <th class="text-center">@sortablelink('mobile', 'Mobile')</th>
                                <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                                <th class="text-center">@sortablelink('created_at', 'Created')</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr @if($user->deleted_at != null) class="table-danger" @endif >
                                    <td class="exclude-search align-middle">
                                        {{ $user->id }}
                                    </td>
                                    <td class="text-left pl-0">
                                        <div class="media">
                                            <img class="align-self-center mr-1 img-circle direct-chat-img elevation-1"
                                                 src="{{ $user->getFirstMediaUrl('avatars') }}" alt="{{ $user->name }}">
                                            <div class="media-body">
                                                <p class="my-0">
                                                    @if(auth()->user()->can('core.settings.users.show') || $user->id == auth()->user()->id)
                                                        <a href="{{ route('core.settings.users.show', $user->id) }}">
                                                            {{ $user->name }}
                                                        </a>
                                                    @else
                                                        {{ $user->name }}
                                                    @endif
                                                </p>
                                                <p class="mb-0 small">{{ $user->username }}</p>
                                            </div>
                                        </div>


                                    </td>
                                    <td class="text-left">{{ $user->email ?? '-' }}</td>
                                    <td class="text-center">{{ $user->mobile ?? '-' }}</td>
                                    <td class="text-center exclude-search">
                                        {!! \Html::enableToggle($user) !!}
                                    </td>
                                    <td class="text-center">{{ $user->created_at->format(config('app.datetime')) ?? '' }}</td>
                                    <td class="exclude-search pr-3 text-center align-middle">
                                        {!! \Html::actionDropdown('core.settings.users', $user->id, array_merge(['show', 'edit'], ($user->deleted_at == null) ? ['delete'] : ['restore'])) !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="exclude-search text-center">No data to display</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent pb-0">
                    {!! \Modules\Core\Supports\CHTML::pagination($users) !!}
                </div>
            @else
                <div class="card-body min-vh-100">

                </div>
            @endif
        </div>
    </div>
    <!-- /.container-fluid -->
    {!! \Modules\Core\Supports\CHTML::confirmModal('User', ['export', 'delete', 'restore']) !!}
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

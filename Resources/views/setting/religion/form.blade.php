<div class="card-body">
    <div class="row">
        <div class="@if(isset($religion->name)) col-md-6 @else col-md-12 @endif">
            {!! \Form::nText('name', 'Name', old('name', $religion->name ?? null), true) !!}
        </div>
        @if(isset($religion->name))
            <div class="col-md-6">
                {!! \Form::nSelect('enabled', 'Enabled', \Modules\Core\Supports\Constant::ENABLED_OPTIONS,
                    old('enabled', ($religion->enabled ?? \Modules\Core\Supports\Constant::ENABLED_OPTION)), true) !!}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            {!! \Form::nTextarea('remarks', 'Remarks', old('remarks', $religion->remarks ?? null), false) !!}
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 justify-content-between d-flex">
            {!! \Form::nCancel('Cancel') !!}
            {!! \Form::nSubmit('submit', 'Save') !!}
        </div>
    </div>
</div>


@push('page-script')
    <script>
        $(function () {
            $("#permission-form").validate({
                rules: {
                    display_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 255,
                        regex: '{{ \Modules\Core\Supports\Constant::PERMISSION_NAME_ALLOW_CHAR }}',
                    },
                    enabled: {
                        required: true
                    },
                    remarks: {},
                },
                messages: {
                    name: {
                        regex: 'Only Alphanumeric, Hyphen(-), uUnderScope(_), Fullstops(.) Allowed'
                    }
                }
            });
        });
    </script>
@endpush

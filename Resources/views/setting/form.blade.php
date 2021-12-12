@push('page-style')
    <!-- Fontawesome -picker -->
    <link rel="stylesheet"
          href="{{ asset('modules/admin/plugins/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css') }}"
          type="text/css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
          href="{{ asset('modules/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endpush

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            {!! \Form::nText('name', 'Name', old('name', $setting->name ?? null), true) !!}
        </div>
        <div class="col-md-6">
            {!! \Form::nSelect('route', 'Route', $routes, old('route', $setting->route ?? null), true) !!}
        </div>

        <div class="col-md-4">
            {!! \Form::nText('icon', 'Icon', old('icon', $setting->icon ?? null), true, ['class' => 'form-control icp icp-auto']) !!}
        </div>
        <div class="col-md-4">
            {!! \Form::nText('color', 'Color', old('color', $setting->color ?? null), true) !!}
        </div>
        <div class="col-md-4">
            {!! \Form::nSelect('enabled', 'Enabled', \Modules\Core\Supports\Constant::ENABLED_OPTIONS,
                old('enabled', ($setting->enabled ?? \Modules\Core\Supports\Constant::ENABLED_OPTION)), true) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {!! \Form::nText('description', 'Description', old('remarks', $setting->remarks ?? null), false) !!}
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 justify-content-between d-flex">
            {!! \Form::nCancel('Cancel') !!}
            {!! \Form::nSubmit('submit', 'Save') !!}
        </div>
    </div>
</div>

@push('plugin-script')
    <script type="text/javascript"
            src="{{ asset('modules/admin/plugins/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('modules/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
@endpush

@push('page-script')
    <script>
        $(function () {
            $('#color').colorpicker()
            $('.icp-auto').iconpicker({
                templates: {
                    popover: '<div class="iconpicker-popover popover fade show"><div class="arrow"></div>' +
                        '<div class="popover-title"></div><div class="popover-content"></div></div>',
                }
            });

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

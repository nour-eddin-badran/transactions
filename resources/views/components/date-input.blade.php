<div class="form-group {{ $required == true ? 'required' : '' }}">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="input-group date datepicker" id="{{$id}}DatePicker">
            <input type="text" name="{{$name}}" value="{{isset($attributes['entity']) ? $attributes['entity'][$name] : ''}}" id="{{$id}}" class="form-control @error($name) is-invalid @enderror"><span class="input-group-addon"><i data-feather="calendar"></i></span>
        </div>
        @error($name)
        <span class="invalid-feedback block d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
        @enderror
    </div>
</div>

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('custom-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function() {
            'use strict';

            if($("#{{$id}}DatePicker").length) {
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                $("#{{$id}}DatePicker").datepicker({
                    format: "yyyy/mm/dd",
                    todayHighlight: true,
                    // startDate: today,
                    autoclose: true
                });
                $("#{{$id}}DatePicker").datepicker('setDate', new Date($("#{{$id}}").val()));
            }

        });
    </script>
@endpush

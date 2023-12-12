<div class="form-group {{ $required == true ? 'required' : '' }}">
    <h6 class="card-title" >{{ $label  }}</h6>
    <div class="custom-control custom-switch">

        <input type="checkbox" name="{{$name}}"
               {{--{{isset($required) && $required == true ? 'required' : ''}}--}}
               class="custom-control-input" id="{{$id}}"
               {{(isset($attributes['entity']) && $attributes['entity']->getRawOriginal($name)) ? 'checked' : ''}}
               onclick="document.getElementById('lbl_status').innerText = this.checked ? '{{__('admin.is_active')}}' : '{{__("admin.is_not_active")}}'; "
        />
        <label class="custom-control-label" id="lbl_status"
               for="{{$id}}">{{isset($attributes['entity']) ? $attributes['entity']['is_active'] : __("admin.is_not_active") }}</label>
    </div>
</div>

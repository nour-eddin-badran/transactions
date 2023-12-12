<form class="p-4" id="report-form" action="{{route('reports.generate')}}" method="post">
    @csrf
    <x-date-input id="report-from" label="{{ __('common.from')}}" name="from" type="text" :entity="null"/>

    <x-date-input id="report-to" label="{{ __('common.to')}}" name="to" type="text" :entity="null"/>

    <button id="btn-update" type="submit" class="btn btn-primary mr-2">{{ __('admin.update')}}</button>
    <button type="button" class="btn btn-secondary"
            data-dismiss="modal">{{ __('common.cancel') }}</button>

</form>

<form class="p-4" id="transaction-form" action="@yield('form-route')" method="post" enctype="multipart/form-data">
    @csrf
    @yield('form-method')

    <x-input id="transaction-amount" label="{{ __('common.amount')}}" name="amount" :entity="$transaction ?? ''"/>

    <x-select id="transaction-user-id" label="{{ __('common.payer')}}" name="user_id" :resources="$users" :entity_id="isset($transaction) ? $transaction->user_id : 0" />

    <x-date-input id="transaction-due-on" label="{{ __('common.due_on')}}" name="due_on" type="text" :entity="$transaction ?? null" />

    <x-input id="transaction-vat" label="{{ __('common.vat')}}" name="vat" :entity="$transaction ?? ''"/>

    <x-switch-input id="transaction-is-vat-inclusive" label="{{ __('common.is_vat_inclusive')}}" name="is_vat_inclusive" :entity="$transaction ?? null"/>


    @if(isset($source) && $source == 'update')
        <button id="btn-update" type="submit" class="btn btn-primary mr-2">{{ __('admin.update')}}</button>
        <a id="btn-cancel" href="{{route('admin.transactions.index')}}"
           class="btn btn-light">{{__('admin.cancel')}}</a>
    @endif

</form>

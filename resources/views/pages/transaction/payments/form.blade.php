<form class="p-4" id="bank-form" action="@yield('form-route')" method="post" enctype="multipart/form-data">
    @csrf
    @yield('form-method')

    <x-input id="payment-amount" label="{{ __('common.amount')}}" name="amount" :entity="$payment ?? ''"/>

    <x-date-input id="payment-paid-on" label="{{ __('common.paid_on')}}" name="paid_on" type="text" :entity="$payment ?? null" />

    <x-textarea id="payment-details" label="{{ __('common.details')}}" name="details"  :entity="$payment ?? ''" />

    @if(isset($source) && $source == 'update')
        <button id="btn-update" type="submit" class="btn btn-primary mr-2">{{ __('admin.update')}}</button>
        <a id="btn-cancel" href="{{route('admin.payments.index')}}"
           class="btn btn-light">{{__('admin.cancel')}}</a>
    @endif

</form>

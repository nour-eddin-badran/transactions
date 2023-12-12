<x-modal id="add-payment-modal" title="{{__('common.add') . ' ' . __('common.payment')}}" uri="{{route('payments.store', $transaction->id)}}" dataTableId="payments-table">
    <x-slot name="body">
        @include('pages.transaction.payments.form')
    </x-slot>

    <x-slot name="metaJS">
        <script>
            payload_add_payment_modal = {
                amount: "payment-amount",
                paid_on: "payment-paid-on",
                details: "payment-details"
            }
            required_add_payment_modal = {
                amount: "payment-amount",
                paid_on: "payment-paid-on",
            }
        </script>
    </x-slot>
</x-modal>

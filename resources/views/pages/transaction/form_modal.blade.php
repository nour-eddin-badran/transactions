<x-modal id="add-transaction-modal" title="{{__('common.add') . ' ' . __('common.transaction')}}" uri="{{route('transactions.store')}}" dataTableId="transactions-table">
    <x-slot name="body">
        @include('pages.transaction.form')
    </x-slot>

    <x-slot name="metaJS">
        <script>
            payload_add_transaction_modal = {
                amount: "transaction-amount",
                user_id: "transaction-user-id",
                due_on: "transaction-due-on",
                vat: "transaction-vat",
                is_vat_inclusive: "transaction-is-vat-inclusive",
            }
            required_add_transaction_modal = {
                amount: "transaction-amount",
                user_id: "transaction-user-id",
                due_on: "transaction-due-on",
            }
        </script>
    </x-slot>
</x-modal>

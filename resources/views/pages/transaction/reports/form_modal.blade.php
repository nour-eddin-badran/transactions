<x-modal id="generate-report-modal" title="{{ __('common.generate_report')}}" uri="{{route('reports.generate')}}" dataTableId="transactions-table">
    <x-slot name="body">
        @include('pages.transaction.reports.form')
    </x-slot>

    <x-slot name="metaJS">
        <script>
            payload_generate_report_modal = {
                from: "report-from",
                to: "report-to",
            }
            required_generate_report_modal = {
                from: "report-from",
                to: "report-to",
            }
        </script>
    </x-slot>
    <x-slot name="footer">

    </x-slot>
</x-modal>

@extends('layout.master')
@section('form-route'){{route('transactions.update', $transaction->id)}}@endsection
@section('form-method') @method('put') @endsection

@section('title')<h4 class="card-title">{{__('admin.update')}}</h4>@endsection

@push('custom-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
@endpush

@section('content')
@include('layout.datatable')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('admin.transactions.index') !!}">{{__('common.transactions')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$transaction->name}}</li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="transactions-overview-tab" data-toggle="tab" href="#transactions-overview" role="tab"
               aria-controls="transactions-overview-tab" aria-selected="true">{{__('common.overview')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="transactions-payments-tab" data-toggle="tab" href="#transactions-payments" role="tab"
               aria-controls="transactions-payments-tab" aria-selected="true">{{__('common.payments')}}</a>
        </li>
    </ul>

    <div class="row">
        <div class="tab-content border border-top-0 p-3 w-100" id="myTabContent">
            <div class="tab-pane fade show active" id="transactions-overview" role="tabpanel" aria-labelledby="transactions-overview-tab">
                @include('pages.transaction.form', [
                    'transaction' => $transaction,
                    'source' => 'update'
                ])
            </div>
            <div class="tab-pane fade show" id="transactions-payments" role="tabpanel" aria-labelledby="transactions-payments-tab">
                @include('pages.transaction.payments.index', [
                    'transaction' => $transaction,
                ])
            </div>
        </div>
    </div>
@endsection

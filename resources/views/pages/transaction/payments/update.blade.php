@extends('layout.master')

@section('form-route'){{route('payments.update', $payment->id)}}@endsection
@section('form-method') @method('put') @endsection

@section('title')<h4 class="card-title">{{__('admin.update')}}</h4>@endsection

@push('custom-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
@endpush

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('admin.payments.index') !!}">{{__('common.payments')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$payment->name}}</li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="payments-overview-tab" data-toggle="tab" href="#payments-overview" role="tab"
               aria-controls="payments-overview-tab" aria-selected="true">{{__('common.overview')}}</a>
        </li>
    </ul>

    <div class="row">
        <div class="tab-content border border-top-0 p-3 w-100" id="myTabContent">
            <div class="tab-pane fade show active" id="payments-overview" role="tabpanel" aria-labelledby="payments-overview-tab">
                @include('pages.payment.form', [
                    'payment' => $payment,
                    'source' => 'update'
                ])
            </div>
        </div>
    </div>
@endsection

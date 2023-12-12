<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Dtos\PaymentDto;
use App\Dtos\TransactionDto;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Transaction\AddPaymentRequest;
use App\Http\Requests\Transaction\AddTransactionRequest;
use App\Http\Resources\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Services\Transaction\TransactionPaymentService;
use App\Services\Transaction\TransactionService;
use App\Traits\MessageHandleHelper;
use Illuminate\Http\Request;

class TransactionPaymentController extends BaseController
{
    use MessageHandleHelper;

    public function __construct(private TransactionPaymentService $transactionPaymentService) {
        parent::__construct();
    }

    public function index(Request $request, Transaction $transaction)
    {
        if ($request->ajax()) {
            $transactions = $this->transactionPaymentService->getDataForDatatable($transaction);

            return prepareDataTable($transactions, 'payments');
        }

//        return view('pages.transaction.index', [);
    }

    public function store(AddPaymentRequest $request, Transaction $transaction)
    {
        $this->transactionPaymentService->add($transaction, new PaymentDto(
            $request->amount,
            $request->paid_on,
            $request->details,
        ));

        return $this->successResponse();
    }

    public function edit(Transaction $transaction)
    {
        $payers = User::whereRelation('roles', 'name', RoleTypeEnum::PAYER)->get();

        return view("pages.transaction.update", [
            'users' => $payers,
            'transaction' => $transaction
        ]);
    }

    public function update(AddTransactionRequest $request, Transaction $transaction)
    {
        $this->transactionService->update($transaction, new TransactionDto(
            $request->amount,
            $request->user_id,
            $request->due_on,
            $request->vat,
            $request->is_vat_inclusive,
        ));

        return redirect()->back();
    }

    public function destroy(Transaction $transaction)
    {
        $this->transactionService->destroy($transaction);
        return $this->successResponse();
    }

}

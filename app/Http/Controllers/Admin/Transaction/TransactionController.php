<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Dtos\TransactionDto;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Transaction\AddTransactionRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Services\Transaction\TransactionService;
use App\Traits\MessageHandleHelper;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use MessageHandleHelper;

    public function __construct(private TransactionService $transactionService) {
        parent::__construct();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = $this->transactionService->getDataForDatatable();

            return prepareDataTable($transactions, 'transactions');
        }

        $payers = User::whereRelation('roles', 'name', RoleTypeEnum::PAYER)->get();

        return view('pages.transaction.index', [
            'users' => $payers
        ]);
    }

    public function store(AddTransactionRequest $request)
    {
        $this->transactionService->add(new TransactionDto(
            $request->amount,
            $request->user_id,
            $request->due_on,
            $request->vat,
            $request->is_vat_inclusive == "true",
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

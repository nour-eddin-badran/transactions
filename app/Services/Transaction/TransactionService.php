<?php

namespace App\Services\Transaction;

use App\Dtos\TransactionDto;
use App\Exceptions\UserException;
use App\Http\Resources\Api\PaginatedCollection;
use App\Http\Resources\Transaction as TransactionResource;
use App\Http\Resources\Api\Transaction as TransactionApiResource;
use App\Models\Transaction;
use App\Models\User;
use App\Modules\EnumManager\Enums\GeneralEnum;
use App\Modules\EnumManager\Enums\PermissionTypeEnum;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Services\BaseService;
use Illuminate\Http\Response;

class TransactionService extends BaseService
{
    public function __construct(protected Transaction $transaction)
    {
        parent::__construct($this->transaction);
    }

    protected $relations = [
        'user'
    ];

    public function getDataForDatatable()
    {
        $query = $this->getQuery()->withCount('payments');
        $result = $query->get();

        return TransactionResource::collection($result);
    }

    public function add(TransactionDto $transactionDto): void
    {
        $transaction = $this->transaction->create([
            'amount' => $transactionDto->getAmount(),
            'user_id' => $transactionDto->getUserId(),
            'due_on' => strtotime($transactionDto->getDueOn()),
            'vat' => $transactionDto->getVat(),
            'is_vat_inclusive' => $transactionDto->getIsVatInclusive(),
        ]);
    }

    public function update(Transaction $transaction, TransactionDto $transactionDto): void
    {
        $transaction->update([
            'amount' => $transactionDto->getAmount(),
            'user_id' => $transactionDto->getUserId(),
            'due_on' => strtotime($transactionDto->getDueOn()),
            'vat' => $transactionDto->getVat(),
            'is_vat_inclusive' => $transactionDto->getIsVatInclusive(),
        ]);
    }

    public function getMyTransactions()
    {
        $query = $this->transaction->with('paymentsOrderedDesc')->withCount('payments');

        if (authUser()->hasRole(RoleTypeEnum::PAYER)) {
            $query->whereUserId(authUser()->id);
        }

        $limit = (int)request()->get('limit', config('website.items_per_page'));

        $transactions = $query->orderByDesc('id')->paginate($limit);

        return new PaginatedCollection($transactions, TransactionApiResource::class);
    }

    public function destroy(Transaction $transaction): void
    {
        $transaction->delete();
    }

    public function getAmountAfterVat(Transaction $transaction)
    {
        $amount = $transaction->amount;

        if ((bool)$transaction->is_vat_inclusive) {
            return $amount;
        }

        $vat = $transaction->vat / 100;
        return $amount + ($amount * $vat);
    }
}

<?php

namespace App\Services\Transaction;

use App\Dtos\PaymentDto;
use App\Dtos\TransactionDto;
use App\Exceptions\UserException;
use App\Http\Resources\Api\PaginatedCollection;
use App\Http\Resources\Payment as PaymentResource;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\User;
use App\Modules\EnumManager\Enums\GeneralEnum;
use App\Modules\EnumManager\Enums\PermissionTypeEnum;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Services\BaseService;
use Illuminate\Http\Response;

class TransactionPaymentService extends BaseService
{

    public function __construct(protected TransactionPayment $transactionPayment)
    {
        parent::__construct($this->transactionPayment);
    }

    protected $relations = [

    ];

    public function getDataForDatatable(Transaction $transaction)
    {
        $query = $this->getQuery()->whereTransactionId($transaction->id);
        $result = $query->get();

        return PaymentResource::collection($result);
    }

    public function add(Transaction $transaction, PaymentDto $paymentDto): void
    {
        $transaction = $this->transactionPayment->create([
            'transaction_id' => $transaction->id,
            'amount' => $paymentDto->getAmount(),
            'paid_on' => strtotime($paymentDto->getPaidOn()),
            'details' => $paymentDto->getDetails(),
        ]);
    }
}

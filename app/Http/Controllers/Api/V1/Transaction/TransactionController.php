<?php

namespace App\Http\Controllers\Api\V1\Transaction;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Services\ArticleService;
use App\Services\Transaction\TransactionService;

class TransactionController extends BaseApiController
{
    public function __construct(private TransactionService $transactionService) { }

    public function index()
    {
        $transactions = $this->transactionService->getMyTransactions();

        return $this->successResponse($transactions);
    }

}

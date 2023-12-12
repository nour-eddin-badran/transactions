<?php

namespace App\Services\Report;

use App\Http\Resources\SimpleTransaction;
use App\Models\Transaction;
use App\Services\BaseService;
use App\Traits\Exportable;

class ReportService extends BaseService
{
    use Exportable;

    public function __construct(protected Transaction $transaction)
    {
        parent::__construct($this->transaction);
    }

    public function generate()
    {
        $from = request()->get('from');
        $to = request()->get('to');

        if (!$from || !$to) {
            return redirect()->back();
        }

        $from = "{$from} 00:00:00";
        $to = "{$to} 23:59:59";

        $transactions = $this->transaction->with(['user', 'payments'])->withCount('payments')->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get()->map(function($transaction) {
            return (new SimpleTransaction($transaction))->toArray(null);
        });

        return $this->export('transactions', $transactions->toArray());
    }
}

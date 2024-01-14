<?php

namespace App\Services\Report;

use App\Http\Resources\PerformanceReport;
use App\Http\Resources\SimpleTransaction;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Services\BaseService;
use App\Traits\Exportable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService extends BaseService
{
    use Exportable;

    public function __construct(protected Transaction $transaction)
    {
        parent::__construct($this->transaction);
    }

    public function generate()
    {
        $startMonth = Carbon::createFromFormat('Y-m', request()->get('from'));
        $endMonth = Carbon::createFromFormat('Y-m', request()->get('to'));

        $monthsArray = [];

        while ($startMonth->lte($endMonth)) {
            $monthsArray[] = "'{$startMonth->year}-{$startMonth->format('m')}'";
            $startMonth->addMonth();
        }
        $targetedMonths = implode(',', $monthsArray);

        //TODO need to be refactored more
        $result = DB::table(DB::raw("
        (SELECT
            t1.targeted_months,
            t1.paid,
            (t2.outstanding - t1.paid) as outstanding,
            (t3.outstanding - t1.paid) as overdue
        FROM
            (SELECT
                DATE_FORMAT(FROM_UNIXTIME(paid_on), '%Y-%m') as targeted_months,
                SUM(amount) as paid
            FROM
                `transaction_payments`
            WHERE
                DATE_FORMAT(FROM_UNIXTIME(paid_on), '%Y-%m') IN ({$targetedMonths})
            GROUP BY
                DATE_FORMAT(FROM_UNIXTIME(paid_on), '%Y-%m')) as t1
        LEFT OUTER JOIN
            (SELECT
                DATE_FORMAT(FROM_UNIXTIME(due_on), '%Y-%m') as targeted_months,
                SUM(amount) as outstanding
            FROM
                transactions
            WHERE
                FROM_UNIXTIME(due_on) >= NOW()
            GROUP BY
                DATE_FORMAT(FROM_UNIXTIME(due_on), '%Y-%m')) as t2
        ON
            t1.targeted_months = t2.targeted_months

        LEFT OUTER JOIN
            (SELECT
                DATE_FORMAT(FROM_UNIXTIME(due_on), '%Y-%m') as targeted_months,
                SUM(amount) as outstanding
            FROM
                transactions
            WHERE
                FROM_UNIXTIME(due_on) < NOW()
            GROUP BY
                DATE_FORMAT(FROM_UNIXTIME(due_on), '%Y-%m')) as t3
        ON
            t1.targeted_months = t3.targeted_months) AS outer_query;
"))->get();

        $data = json_decode(json_encode($result->toArray()), true);

        $data = PerformanceReport::collection($data);

        return $this->export('transactions', $data->toArray(null));
    }
}

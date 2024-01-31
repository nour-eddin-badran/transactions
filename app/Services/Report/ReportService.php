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

        $subquery1 = DB::table('transaction_payments')->whereRaw("DATE_FORMAT(FROM_UNIXTIME(paid_on), '%Y-%m') IN ({$targetedMonths})")
            ->groupByRaw("DATE_FORMAT(FROM_UNIXTIME(paid_on), '%Y-%m')")
            ->selectRaw("DATE_FORMAT(FROM_UNIXTIME(paid_on), '%Y-%m') as targeted_months,
                SUM(amount) as paid");


        $subquery2 = DB::table('transactions')->whereRaw("FROM_UNIXTIME(transactions.due_on) >= NOW()")
            ->groupByRaw("DATE_FORMAT(FROM_UNIXTIME(transactions.due_on), '%Y-%m')")
            ->selectRaw("DATE_FORMAT(FROM_UNIXTIME(due_on), '%Y-%m') as targeted_months,
                SUM(amount) as outstanding");

        $subquery3 = DB::table('transactions')->whereRaw("FROM_UNIXTIME(due_on) < NOW()")
            ->groupByRaw("DATE_FORMAT(FROM_UNIXTIME(transactions.due_on), '%Y-%m')")
            ->selectRaw(" DATE_FORMAT(FROM_UNIXTIME(due_on), '%Y-%m') as targeted_months,
                            SUM(amount) as overdue");

        $result = DB::table(DB::raw("({$subquery1->toSql()}) as t1"))
            ->leftJoin(DB::raw("({$subquery2->toSql()}) as t2"), 't1.targeted_months', '=', 't2.targeted_months')
            ->leftJoin(DB::raw("({$subquery3->toSql()}) as t3"), 't1.targeted_months', '=', 't3.targeted_months')
            ->select([
                't1.targeted_months',
                't1.paid',
                DB::raw('(t2.outstanding - t1.paid) as outstanding'),
                DB::raw('(t3.overdue - t1.paid) as overdue')
            ])->get();

        $data = json_decode(json_encode($result->toArray()), true);

        $data = PerformanceReport::collection($data);

        return $this->export('transactions', $data->toArray(null));
    }
}

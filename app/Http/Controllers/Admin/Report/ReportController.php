<?php

namespace App\Http\Controllers\Admin\Report;

use App\Dtos\TransactionDto;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Transaction\AddTransactionRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Services\Report\ReportService;
use App\Services\Transaction\TransactionService;
use App\Traits\MessageHandleHelper;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
    use MessageHandleHelper;

    public function __construct(private ReportService $reportService)
    {
        parent::__construct();
    }

    public function generate(Request $request)
    {
        return $this->reportService->generate();
    }
}

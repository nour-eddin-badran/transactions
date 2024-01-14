<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PerformanceReport extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'month' => Carbon::createFromFormat('Y-m', $this->resource['targeted_months'])->month,
            'year' => Carbon::createFromFormat('Y-m', $this->resource['targeted_months'])->year,
            'paid' => $this->resource['paid'] ?? 0,
            'outstanding' => $this->resource['outstanding'] ?? 0,
            'overdue' => $this->resource['overdue'] ?? 0,
        ];
    }
}

<?php

namespace App\Models;

use App\Modules\EnumManager\Enums\TransactionStatusEnum;
use App\Services\Transaction\TransactionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'user_id', 'due_on', 'vat', 'is_vat_inclusive'
    ];

    public function getDueOnAttribute($dueOn): string
    {
        return (new Carbon($dueOn))->toDateString();
    }

    public function getAmountAttribute($amount)
    {
        if ((bool)$this->is_vat_inclusive) {
            return $amount;
        }

        $vat = $this->vat / 100;
        return $amount + ($amount * $vat);
    }

    public function getStatusAttribute(): string
    {
        $totalPaid = $this->payments->sum('amount');

        if ($totalPaid == $this->amount) {
            return 'Paid';
        }

        $dueOn = $this->getRawOriginal('due_on');

        if ($dueOn <= now()->timestamp) {
            return TransactionStatusEnum::OVERDUE;
        }

        return TransactionStatusEnum::OUTSTANDING;
    }

    public function getRemainingAttribute()
    {
        $totalPaid = $this->payments->sum('amount');
        return $this->amount - $totalPaid;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(TransactionPayment::class);
    }

    public function paymentsOrderedDesc(): HasMany
    {
        return $this->payments()->orderBy('id', 'desc');
    }
}

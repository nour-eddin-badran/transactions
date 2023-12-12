<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class TransactionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
      'transaction_id', 'amount', 'paid_on', 'details'
    ];

    public function transaction(): BelongsTo
    {
        return  $this->belongsTo(Transaction::class);
    }

    public function getPaidOnAttribute($paidOn): string
    {
        return (new Carbon($paidOn))->toDateString();
    }
}

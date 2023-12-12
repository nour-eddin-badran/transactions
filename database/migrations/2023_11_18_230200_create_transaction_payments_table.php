<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->comment('The transaction to which this payment belongs')->constrained('transactions')->cascadeOnDelete();
            $table->float('amount')->comment('The paid amount. This can be part of the total transaction amount.');
            $table->integer('paid_on')->index()->comment('The date on which this payment was received');
            $table->text('details')->nullable()->comment('Additional comments that can be entered by the admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_payments');
    }
};

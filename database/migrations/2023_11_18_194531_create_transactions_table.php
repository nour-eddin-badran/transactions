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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->comment('The total amount of the transaction');
            $table->foreignId('user_id')->comment('The customer who will pay the given amount')->constrained('users')->cascadeOnDelete();
            $table->integer('due_on')->index()->comment('The date on which the customer should pay');
            $table->tinyInteger('vat')->comment('The VAT percentage');
            $table->boolean('is_vat_inclusive')->index()->comment('Is the VAT amount included in the entered amount');
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('invoice_date');
            $table->string('invoice_no');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email');
            $table->string('billing_address')->nullable();
            $table->string('shipping_address')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('note')->nullable();
            $table->string('merchant_name');
            $table->string('status');
            $table->string('pdf_name');
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
        Schema::dropIfExists('invoices');
    }
}

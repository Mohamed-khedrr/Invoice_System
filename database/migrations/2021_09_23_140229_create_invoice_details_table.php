<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_invoice");
            $table->foreign('id_invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('invoice_number');
            $table->string('product');
            $table->string('section');
            $table->string('status');
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->date('payment_date')->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
}

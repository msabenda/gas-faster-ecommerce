<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 8, 2); // Amount in USD
            $table->decimal('amount_tzs', 10, 2); // Amount in TZS
            $table->string('currency', 3); // Currency code (USD)
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->string('order_reference')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
?>
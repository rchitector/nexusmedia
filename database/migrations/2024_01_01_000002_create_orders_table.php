<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignIdFor(Customer::class)->nullable()->constrained();
            $table->float('total_price')->default(0.00)->nullable();
            $table->string('financial_status')->nullable();
            $table->string('fulfillment_status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

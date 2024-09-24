<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Define foreign keys

            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('price');
            $table->enum('status', ['done', 'In progress']);
            $table->date('order_date');
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

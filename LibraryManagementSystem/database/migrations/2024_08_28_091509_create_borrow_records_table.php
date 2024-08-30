<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
   (مفتاح رئيسي)
book_id (معرّف الكتاب، مفتاح)
user_id (معرّف المستخدم، مفتاح)
borrowed_at (تاريخ الاستعارة)
due_date (تاريخ الإعادة)
returned_at (تاريخ الإرجاع)
created_at و updated_at
     */
    public function up(): void
    {
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('user_id')->constrained('users');
            $table->date('borrowed_at');
            $table->date('due_date');
            $table->date('returned_at')->nullable();
            $table->timestamps();
        });
    }
           


    

    /**
     * Reverse the m
     * igrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_records');
    }
};

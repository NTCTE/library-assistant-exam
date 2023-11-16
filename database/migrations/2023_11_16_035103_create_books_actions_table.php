<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books_actions', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('book_id')
                -> references('id')
                -> on('books');
            $table -> foreignId('reader_id')
                -> references('id')
                -> on('readers');
            $table -> date('get_date');
            $table -> date('return_date')
                -> nullable();
            $table -> unsignedInteger('count_of_books')
                -> default(1);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_actions');
    }
};

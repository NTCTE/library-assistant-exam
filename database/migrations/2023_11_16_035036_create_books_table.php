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
        Schema::create('books', function (Blueprint $table) {
            $table -> id();
            $table -> string('fullname', 255)
                -> index();
            $table -> foreignId('type_of_book_id')
                -> references('id')
                -> on('type_of_books');
            $table -> foreignId('author_id')
                -> references('id')
                -> on('authors');
            $table -> foreignId('publishing_id')
                -> references('id')
                -> on('publishings');
            $table -> year('year_of_publishing');
            $table -> unsignedInteger('count_of_sheets');
            $table -> unsignedInteger('count_of_items')
                -> default(1);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

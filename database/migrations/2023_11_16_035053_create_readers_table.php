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
        Schema::create('readers', function (Blueprint $table) {
            $table -> id();
            $table -> string('lastname', 100);
            $table -> string('firstname', 100);
            $table -> string('patronymic', 100)
                -> nullable();
            $table -> enum('type_of_reader', [
                'teacher',
                'student',
                'other',
            ]);
            $table -> foreignId('group_id')
                -> nullable()
                -> references('id')
                -> on('groups');
            $table -> boolean('can_get_books')
                -> default(true);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readers');
    }
};

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
        Schema::create('tbl_review', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('mem_id');   // FK → tbl_member
            $table->unsignedInteger('menu_id');  // FK → tbl_menu
            $table->text('comment');
            $table->tinyInteger('rating');
            $table->timestamp('timestamp')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('mem_id')
                  ->references('mem_id')
                  ->on('tbl_member')
                  ->onDelete('cascade');

            $table->foreign('menu_id')
                  ->references('menu_id')
                  ->on('tbl_menu')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_review');
    }
};

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
        Schema::create('tbl_favorite', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('mem_id');   // ให้ตรงกับ tbl_member.mem_id
            $table->unsignedInteger('menu_id');  // ให้ตรงกับ tbl_menu.menu_id
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
        Schema::dropIfExists('tbl_favorite');
    }
};

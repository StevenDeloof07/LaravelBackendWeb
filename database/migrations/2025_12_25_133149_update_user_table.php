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
        //
        Schema::table("users", function (Blueprint $table) {
            $table->string("picture_link")->default("/images/user/paint.png")->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table("users", function (Blueprint $table) {
            $table->string("picture_link")->default("images/paint.png")->change();
        });
    }
};

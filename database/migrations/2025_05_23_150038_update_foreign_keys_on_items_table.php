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
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['toko_id']);
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['kategori_id']);

            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('restrict');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['toko_id']);
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['kategori_id']);

            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }
};

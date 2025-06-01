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
        Schema::table('wishlists', function (Blueprint $table) {
            // Only add if the column does not already exist
            if (!Schema::hasColumn('wishlists', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('user_id');

                // Add foreign key if desired
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            if (Schema::hasColumn('wishlists', 'product_id')) {
                // Drop foreign key first if it exists
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
        });
    }
};

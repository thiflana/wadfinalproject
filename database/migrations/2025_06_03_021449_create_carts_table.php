<?php
// database/migrations/create_carts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // Store price at time of adding to cart
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'product_id']); // Prevent duplicate items
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
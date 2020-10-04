<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
			$table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
			$table->foreignId('product_id')->constrained('products')->onDelete('cascade');
			$table->integer('quantity');
			$table->enum('status', ['pending', 'complete'])->default('complete');
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('orders', function (Blueprint $table) {
          $table->dropForeign(['user_id']);
		  $table->dropForeign(['payment_id']);
		  $table->dropForeign(['product_id']);
          $table->dropColumn(['user_id', 'payment_id', 'product_id']);
       });
        Schema::dropIfExists('orders');
    }
}
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

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
			$table->string('payment_id', 255);
			//$table->string('name');
			//$table->string('payer_email', 255);
			$table->text('address', 450);
			$table->string('mobile', 15);
			$table->double('amount');
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
		Schema::table('payments', function (Blueprint $table) {
          $table->dropForeign(['user_id']);
          $table->dropColumn(['user_id']);
       });
        Schema::dropIfExists('payments');
    }
}
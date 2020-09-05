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

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
			$table->text('address', 450);
			$table->string('mobile', 15);
			$table->string('facebook', 255)->nullable();
			$table->string('image')->nullable();
			$table->ipAddress('ip');
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
		Schema::table('user_infos', function (Blueprint $table) {
          $table->dropForeign(['user_id']);
          $table->dropColumn(['user_id']);
       });
        Schema::dropIfExists('user_infos');
    }
}

<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminInfosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admin_infos', function (Blueprint $table) {
            $table->id();
            $table->text('address', 450);
            $table->string('mobile', 15);
            $table->string('facebook', 255)->nullable();
            $table->string('image')->nullable();
            $table->ipAddress('ip');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('admin_infos', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['admin_id']);
        });
        Schema::dropIfExists('admin_infos');
    }
}

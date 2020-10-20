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

class AddIsadminColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('isAdmin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}

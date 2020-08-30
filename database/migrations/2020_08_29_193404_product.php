<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('titile');
            
        $table->bigIncrements('category_id');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
$table->double('price');

$table->integer('views')->default(0);

$table->integer('quantity')->default(1);

$table->bigIncrements('admin_id');     

$table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
           
           $table->
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('products', function (Blueprint $table) {
          $table->dropForeign('category_id');
          //$table->dropForeign('')
       });
        Schema::dropIfExists('products');
    }
}
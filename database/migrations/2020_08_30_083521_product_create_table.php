<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCreateTable extends Migration
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
            $table->string('title');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->double('price');
			$table->integer('discounds')->default(0);
			$table->text('description');
            $table->integer('views')->default(0);
            $table->integer('quantity');
            $table->string('image');    
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
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
       Schema::table('products', function (Blueprint $table) {
          $table->dropForeign(['category_id']);
          $table->dropForeign(['admin_id']);
          $table->dropColumn(['category_id', 'admin_id']);
       });
        Schema::dropIfExists('products');
    }
}
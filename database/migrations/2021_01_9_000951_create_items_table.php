<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('slug',50)->unique();
            $table->text('description');
            $table->string('condition',5);
            $table->integer('price',false,true);
            $table->string('photo',50);
            $table->tinyInteger('approve',false,true)->default(0);
            $table->date('date');
            $table->decimal('rate',2,1,true)->default(0.0);
            $table->timestamps();
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}

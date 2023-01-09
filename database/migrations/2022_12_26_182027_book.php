<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table){
            $table->id('id_book')->autoIncrement();
            $table->string('title', 200);
            $table->integer('total_page');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories', 'id_category');
            $table->foreignId('publisher_id')->constrained('publishers', 'id_publisher');
            $table->text('path_img')->nullable();
            $table->unsignedInteger('jml_tersedia')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};

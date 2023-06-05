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
        Schema::create('carts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('member_id')->constrained('members');
            $table->unsignedInteger('total_day')->default(1);
            $table->boolean('is_checkout')->default(false);
            $table->enum('is_approve', ['pending','approve','decline', 'returned'])->default('pending');
            $table->timestamp('created_at')->nullable();
            $table->integer('biaya');
            $table->integer('denda')->default(0);
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
        Schema::dropIfExists('carts');
    }
};

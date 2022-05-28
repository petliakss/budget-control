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
        Schema::create('payments_histories', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type_id')->comment('1-incomes,2-expenses');
            $table->foreignId('category_id')->constrained();
            $table->tinyInteger('is_required')->default(0);
            $table->decimal('sum')->default(0);
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->index(['type_id', 'category_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_histories');
    }
};

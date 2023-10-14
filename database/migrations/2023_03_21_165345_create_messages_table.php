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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->index()->default(0);
            $table->foreignId('send_id')->index()->default(0);
            $table->foreignId('recv_id')->index()->default(0);
            $table->text('content')->default('');
            $table->boolean('read_flg_01')->default(0);
            $table->boolean('read_flg_02')->default(0);
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
        Schema::dropIfExists('messages');
    }
};

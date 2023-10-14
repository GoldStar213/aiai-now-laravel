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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('original_id')->unique();
            $table->string('title');
            $table->string('url')->nullable()->default('');
            $table->string('youtube_url')->nullable()->default('');
            $table->foreignId('category_id')->index()->default(0);
            $table->foreignId('region_id')->index()->default(0);
            $table->text('content')->nullable()->default('');
            $table->text('price')->nullable()->default('');
            $table->text('type')->nullable()->default('');
            $table->bigInteger('likes')->default(0);
            $table->integer('rating')->default(0);
            $table->boolean('published')->default(0);
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
        Schema::dropIfExists('services');
    }
};

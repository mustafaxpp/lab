<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipsAndOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips_and_offers', function (Blueprint $table) {
            $table->id();
            // type
            $table->string('type');
            // title
            $table->string('title_ar');
            $table->string('title_en');
            // description
            $table->text('description_ar');
            $table->text('description_en');
            // image
            $table->string('image');
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
        Schema::dropIfExists('tips_and_offers');
    }
}

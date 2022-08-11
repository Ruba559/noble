<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('propery_type_id');
            $table->decimal('price');
            $table->longText('title');
            $table->longText('description');
            $table->integer('city_id');
            $table->decimal('space');
            $table->integer('place_id');
            $table->longText('adress');
            $table->tinyInteger('status');
            $table->integer('rooms');
            $table->integer('salons');
            $table->integer('baths');
            $table->string('floor');
            $table->integer('direction_id');
            $table->integer('cladding_id');
            $table->string('mobile_phone');
            $table->string('image');
            $table->integer('floors');
            $table->longText('divider');
            $table->integer('views');
            $table->tinyInteger('has_elevator');
            $table->tinyInteger('has_generator');
            $table->tinyInteger('has_terrace');
            $table->tinyInteger('has_pool');
            $table->tinyInteger('has_conditioner');
            $table->tinyInteger('has_saona');
            $table->tinyInteger('has_garag');
            $table->tinyInteger('has_shofag');
            $table->tinyInteger('has_jacuzzi');
            $table->tinyInteger('has_garden');
            $table->timestamp('deleted_at');
            $table->string('slug');
            $table->longText('seo_title');
            $table->longText('seo_description');
            $table->longText('long')->nullable();
            $table->longText('lat')->nullable();
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
        Schema::dropIfExists('properties');
    }
}

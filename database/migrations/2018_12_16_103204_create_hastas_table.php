<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hastas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('istasyon_id');
            $table->integer('ambulans_id');
            $table->integer('hastane_id');
            $table->tinyInteger('risk')->default(0);
            $table->string('adi')->nullable();
            $table->string('lat_long');
            $table->boolean('bitti_mi')->default(0);
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
        Schema::dropIfExists('hastas');
    }
}

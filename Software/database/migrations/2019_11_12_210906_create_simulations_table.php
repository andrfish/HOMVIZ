<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('simulations', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('serverID',false)->nullable();
            $table->unsignedInteger('user_id',false);
            $table->longText('data');
            $table->longText('result');
            $table->tinyInteger('status')->default(0);//0:just created,1:processing,2:done
            $table->timestamps();
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
        //
    }
}

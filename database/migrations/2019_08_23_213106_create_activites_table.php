<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('date_time')->nullable();
            $table->string('distance')->nullable();
            $table->string('duration')->nullable();
            $table->string('elevation')->nullable();
            $table->text('description'); 
            $table->bigInteger('typeable_id');
            $table->string('typeable_type');      
            $table->bigInteger('user_id');      
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
        Schema::dropIfExists('activities');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     
    public function up()
    {
        Schema::create('contactform', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250);
            $table->string('email', 150);
            $table->string('attachment', 150)->nullable();
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();
            $table->softDeletes()->nullable();
        });
    }

     
    public function down()
    {
        Schema::dropIfExists('contactform');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permasalahan')->nullable();
            $table->string('penyelesaian')->nullable();
            $table->date('tgl_followups')->nullable();
            $table->string('pengerjaan')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('pengaduan_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')
            ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('followups');
    }
}

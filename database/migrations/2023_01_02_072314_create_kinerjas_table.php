<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinerjas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poin_cek')->nullable();
            $table->integer('poin_selesai')->nullable();
            $table->string('over_cek')->nullable();
            $table->string('over_selesai')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('pengaduan_id')->nullable();
            $table->unsignedInteger('followup_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')
            ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('followup_id')->references('id')->on('followups')
            ->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('kinerjas');
    }
}

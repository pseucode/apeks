<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip')->nullable();
            $table->string('barang')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tgl_aduan')->nullable();
            $table->string('isi_aduan')->nullable();
            $table->string('permasalahan')->nullable();
            $table->string('penyelesaian')->nullable();
            $table->date('tgl_followups')->nullable();
            $table->string('pengerjaan')->nullable();
            $table->string('status')->nullable();
            $table->string('catatan')->nullable();
            $table->string('signature')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('pelapor_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pelapor_id')->references('id')->on('pelapors')
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
        Schema::dropIfExists('pengaduans');
    }
}

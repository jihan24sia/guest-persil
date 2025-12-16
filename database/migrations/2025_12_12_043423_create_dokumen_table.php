<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('dokumen', function (Blueprint $table) {
        $table->id('dokumen_id');

        $table->unsignedBigInteger('persil_id'); // FK ke persil

        $table->string('jenis_dokumen');
        $table->string('nomor');
        $table->text('keterangan')->nullable();

        $table->timestamps();

        $table->foreign('persil_id')
              ->references('persil_id')
              ->on('persil')
              ->onDelete('cascade');
    });
}
};

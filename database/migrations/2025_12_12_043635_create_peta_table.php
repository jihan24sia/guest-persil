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
        Schema::create('peta', function (Blueprint $table) {
            $table->id('peta_id');

            $table->unsignedBigInteger('persil_id')->nullable();

            $table->text('geojson')->nullable();
            $table->float('panjang_m')->nullable();
            $table->float('lebar_m')->nullable();
            $table->timestamps();

            // foreign key sesuai primary key tabel persil
            $table->foreign('persil_id')
                ->references('persil_id')
                ->on('persil')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peta');
    }
};

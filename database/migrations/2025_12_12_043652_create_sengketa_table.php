<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sengketa', function (Blueprint $table) {
            $table->id('sengketa_id');
            $table->unsignedBigInteger('persil_id'); // HARUS unsignedBigInteger
            $table->string('pihak_1');
            $table->string('pihak_2');
            $table->text('kronologi');
            $table->string('status')->default('Proses'); // Proses, Selesai, etc
            $table->text('penyelesaian')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('persil_id')
                  ->references('persil_id')
                  ->on('persil')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sengketa');
    }
};

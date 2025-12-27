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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // Misal: Alam, Kuliner, Sejarah
            $table->text('description');
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('kode_desa')->nullable();
            $table->string('kode_kecamatan')->nullable();
            $table->decimal('ticket_price', 12, 2)->default(0); // Format uang
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->enum('status', ['active', 'inactive', 'renovation'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};

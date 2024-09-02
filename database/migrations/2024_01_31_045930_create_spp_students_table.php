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
        Schema::create('spp_students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('tahun_ajaran');
            $table->integer('price');
            $table->date('tanggal')->nullable();
            $table->string('via')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('status')->default('BELUM BAYAR');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_students');
    }
};

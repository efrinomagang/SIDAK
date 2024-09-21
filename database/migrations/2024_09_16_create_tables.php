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
        // migration for 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['kaprodi', 'dosen', 'mahasiswa']);
            $table->timestamps();
        });

        // migration for 'kelas' table
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('jumlah');
            $table->timestamps();
        });

        // migration for 'kaprodi' table
        Schema::create('kaprodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');
            $table->integer('kode_dosen')->unique();
            $table->integer('nip')->unique();
            $table->string('name');
            $table->timestamps();
        });

        // migration for 'dosen' table
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained()->onDelete('set null'); // <-- make sure it's nullable
            $table->string('kode_dosen');
            $table->string('nip');
            $table->string('name');
            $table->timestamps();
        });

        // migration for 'mahasiswa' table
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->integer('nim')->unique();
            $table->string('name');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->boolean('edit')->default(false);
            $table->timestamps();
        });

        // migration for 'request' table
        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('keterangan');
            $table->string('status')->default('pending'); // Add status field
            $table->boolean('is_read')->default(false);   // Add is_read field to track whether the notification has been viewed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('kaprodi');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('incoming_server');
            $table->string('incoming_username');
            $table->string('incoming_password');
            $table->integer('incoming_port');
            $table->string('incoming_security');
            
            $table->string('outgoing_server');
            $table->string('outgoing_username');
            $table->string('outgoing_password');
            $table->integer('outgoing_port');
            $table->string('outgoing_security');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

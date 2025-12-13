<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();

    // ADD THIS LINE
    $table->string('phone')->nullable(); 

    $table->string('roll_number')->unique();
    $table->string('program');

    // This should already be here from earlier fixes
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); 

    $table->timestamps();
});
    }
    

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
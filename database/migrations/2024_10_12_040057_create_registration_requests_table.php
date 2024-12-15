<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('phelNamespace', 255);
            $table->string('name', 255);
            $table->enum('symbol_type', ['special-form', 'macro', 'function']);
            $table->text('description')->nullable();
            $table->enum('status', ['Requested', 'Reviewed', 'Registered']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_requests');
    }
};

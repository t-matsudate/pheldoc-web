<?php

use App\Models\PhelNamespace;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phel_functions', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignIdFor(PhelNamespace::class)->constrained();
            $table->string('name');
            $table->enum('symbol_type', ['special-form', 'macro', 'function']);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->primary(['id', 'phel_namespace_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phel_functions');
    }
};

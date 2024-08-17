<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usage_examples', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->ulid('phel_function_id');
            $table->text('example');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('phel_function_id')->on('phel_functions')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usage_examples');
    }
};

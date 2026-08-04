<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featured_items', function (Blueprint $table) {
            $table->id();
            $table->string('featurable_type');
            $table->unsignedBigInteger('featurable_id');
            $table->unsignedTinyInteger('position')->default(1);
            $table->timestamps();

            $table->index(['featurable_type', 'featurable_id'], 'featured_items_morph_index');
            $table->unique(['featurable_type', 'featurable_id'], 'featured_items_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_items');
    }
};

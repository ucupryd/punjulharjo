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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('referral_source')->nullable()->after('origin_city');
            $table->integer('cleanliness_rating')->nullable()->after('rating');
            $table->string('activity')->nullable()->after('cleanliness_rating');
            $table->text('suggestions')->nullable()->after('review');
            
            $table->string('one_word', 50)->nullable()->change();
            $table->string('companion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['referral_source', 'cleanliness_rating', 'activity', 'suggestions']);
            
            $table->string('one_word', 50)->nullable(false)->change();
            $table->string('companion')->nullable(false)->change();
        });
    }
};

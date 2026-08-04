<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('blog_category')) {
            $rows = DB::table('blog_category')->get();

            foreach ($rows as $row) {
                // Pastikan idempoten: lewati jika sudah ada
                $exists = DB::table('categorizables')
                    ->where('category_id', $row->category_id)
                    ->where('categorizable_id', $row->blog_id)
                    ->where('categorizable_type', 'App\Models\Blog')
                    ->exists();

                if (!$exists) {
                    DB::table('categorizables')->insert([
                        'category_id' => $row->category_id,
                        'categorizable_id' => $row->blog_id,
                        'categorizable_type' => 'App\Models\Blog',
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categorizables')
            ->where('categorizable_type', 'App\Models\Blog')
            ->delete();
    }
};

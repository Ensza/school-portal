<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Strand;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('curricula', function (Blueprint $table) {
            $table->foreignIdFor(Strand::class)->after('grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curricula', function (Blueprint $table) {
            $table->dropColumn('strand_id');
        });
    }
};

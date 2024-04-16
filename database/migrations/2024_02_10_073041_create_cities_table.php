<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        $cities = [
            'Bridgewatch',
            'Caerleon',
            'Fort Sterling',
            'Lymhurst',
            'Martlock',
            'Thetford',
            'Black Market',
        ];
        foreach ($cities as $city) {
            DB::table('cities')
                ->insert(['title' => $city]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

<?php

use App\Models\Rune;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('runes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('level');
            $table->integer('price')
                ->nullable();
            $table->foreignId('city_id')
                ->constrained();
            $table->timestamps();
        });

        $citiIds = $this->cityIds();
        $tiers = config('items.tiers');
        foreach (Rune::NAMES as $level => $title) {
            foreach ($citiIds as $citiId) {
                foreach ($tiers as $tier) {
                    DB::table('runes')
                        ->insert([
                            'title' => "$tier$title",
                            'level' => $level,
                            'city_id' => $citiId
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
        Schema::dropIfExists('runes');
    }

    protected function cityIds(): array
    {
        return DB::table('cities')
            ->select()
            ->get()
            ->pluck('id')
            ->toArray();
    }
};

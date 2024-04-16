<?php

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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('sell_price')
                ->nullable();
            $table->integer('buy_price')
                ->nullable();
            $table->integer('need_runes');
            $table->foreignId('city_id')
                ->constrained();
            $table->timestamps();
        });

        $cityIds = $this->cityIds();
        /** @var array $tiers */
        $tiers = config('items.tiers');
        /** @var array $equipments */
        $equipments = config('items.equipments');
        /** @var array $charms */
        $charms = config('items.charms');
        foreach ($cityIds as $cityId) {
            foreach ($tiers as $tier) {
                foreach ($charms as $charm) {
                    foreach ($equipments as $name => $needRunes) {
                        DB::table('equipments')->insert([
                            'title' => "$tier$name$charm",
                            'city_id' => $cityId,
                            'need_runes' => $needRunes,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
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

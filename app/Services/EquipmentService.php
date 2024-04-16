<?php

namespace App\Services;

use App\Helpers\UrlHelper;
use App\Models\City;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class EquipmentService
{
    public function charms(Collection $equipments, Collection $runes, Collection $cities): Collection
    {
        $equipmentCharms = $equipments->map(function (Equipment $equipment) {
            $tier = Str::substr($equipment->title, 0, 3);
        });
        return $equipmentCharms;
    }
    public function update(): void
    {
        $cities = City::all();
        $nameGroups = collect($this->nameGroups());
        $nameGroups->map(function ($key, string $names) use ($cities, $nameGroups) {
            $response = collect(UrlHelper::prices($names)->json());
            $response->map(function (array $responseItem) use ($cities) {
                $cities->map(function (City $city) use ($responseItem) {
                    $names = Equipment::names();
                    $names->map(function (string $name) use ($responseItem, $city) {
                        if (
                            $responseItem['city'] === $city->title &&
                            $responseItem['item_id'] === $name
                        ) {
                            Equipment::updateOrCreate([
                                'title' => $name,
                                'city_id' => $city->getKey(),
                            ], [
                                'title' => $name,
                                'city_id' => $city->getKey(),
                                'sell_price' => $responseItem['sell_price_min'] ?: null,
                                'buy_price' => $responseItem['buy_price_min'] ?: null,
                            ]);
                        }
                    });
                });
            });
        });
    }

    protected function nameGroups(): array
    {
        /** @var array $equipments */
        $equipments = config('items.equipments');

        $names = Equipment::names();
        $groups = [];
        /** @var string $equipment */
        foreach ($equipments as $equipment => $needRunes) {
            /** @var string $name */
            foreach ($names as $name) {
                if (stripos($name, $equipment)) {
                    if (!empty($groups[$equipment])) {
                        $groups[$equipment] .= ",$name";
                    } else {
                        $groups[$equipment] = $name;
                    }
                }
            }
        }
        return $groups;
    }
}

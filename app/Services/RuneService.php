<?php

namespace App\Services;

use App\Helpers\UrlHelper;
use App\Models\City;
use App\Models\Rune;
use Illuminate\Support\Collection;

class RuneService
{
    public function update(): void
    {
        $cities = City::all();
        $nameGroups = $this->nameGroups();
        $nameGroups->map(function (string $nameGroup) use ($cities) {
            $response = UrlHelper::prices($nameGroup)->json();
            collect($response)->map(function (array $responseItem) use ($cities) {
                $cities->map(function (City $city) use ($responseItem) {
                    if (
                        $responseItem['city'] === $city->title &&
                        (int)$responseItem['sell_price_min'] > 0
                    ) {
                        Rune::updateOrCreate([
                            'title' => $responseItem['item_id'],
                            'city_id' => $city->getKey(),
                        ], [
                            'title' => $responseItem['item_id'],
                            'city_id' => $city->getKey(),
                            'price' => $responseItem['sell_price_min']
                        ]);
                    }
                });
            });
        });
    }

    protected function nameGroups(): Collection
    {
        $res = [];
        $names = Rune::names();
        foreach (Rune::NAMES as $nameGroup) {
            foreach ($names as $name) {
                if (strpos($name, $nameGroup)) {
                    if (!empty($res[$nameGroup])) {
                        $res[$nameGroup] .= ",$name";
                    } else {
                        $res[$nameGroup] = $name;
                    }
                }
            }
        }
        return collect($res);
    }
}

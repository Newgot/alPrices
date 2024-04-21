<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Equipment;
use App\Models\Rune;
use App\Services\EquipmentService;

class EquipmentController extends Controller
{
    public function __construct(
        protected readonly EquipmentService $service,
    )
    {
    }

    public function index()
    {
        $cities = City::all();
        return view('equipment', [
            'cities' => $cities
        ]);
    }

    public function charm()
    {
//        $equipmentCharms = $this->service->charms(
//            Equipment::all(),
//            Rune::all(),
//            City::all(),
//        );
        return 1;
    }

    public function update()
    {
        $this->service->update();
        return redirect(route('equipment.index'));
    }
}

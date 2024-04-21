<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Rune;
use App\Resources\RuneResource;
use App\Services\RuneService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RuneController extends Controller
{
    public function __construct(
        protected readonly RuneService $service,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return view('runes', [
            'cities' => $cities
        ]);
    }

    public function update()
    {
        $this->service->update();
        return redirect(route('rune.index'));
    }

    public function list(): AnonymousResourceCollection
    {
        return RuneResource::collection(Rune::all());
    }
}

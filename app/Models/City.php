<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 * @property Rune[]|Collection $runes
 * @property Equipment[]|Collection $equipments
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function runes(): HasMany
    {
        return $this->hasMany(Rune::class);
    }

    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    public function equipmentList(): Collection
    {
        return $this->equipments()
            ->where('sell_price', '>', 0)
            ->where('updated_at', '>', Carbon::now()->sub('1 day'))
            ->get();
    }

}

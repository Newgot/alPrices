<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property integer $price
 * @property integer $city_id
 * @property integer $need_runes
 * @method static \Illuminate\Database\Eloquent\Collection get()
 * @method static self groupBy(string $column)
 * @method static self selectRaw(string $raw)
 * @method static self updateOrCreate(array $haystack, array $params)
 *
 */
class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = [
        'title',
        'sell_price',
        'buy_price',
        'city_id',
        'need_runes'
    ];

    protected $casts = [
        'sell_price' => 'integer',
        'buy_price' => 'integer',
        'city_id' => 'integer',
        'need_runes' => 'integer',
    ];

    public static function names(): Collection
    {
        return self::selectRaw('title, count("title")')
            ->groupBy('title')
            ->get()
            ->pluck('title');

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property integer $city_id
 * @property integer $price
 * @method static self updateOrCreate(array $haystack, array $params)
 */
class Rune extends Model
{
    use HasFactory;

    const NAMES = [
        '@1' => 'RUNE',
        '@2' => 'SOUL',
        '@3' => 'RELIC',
    ];

    protected $fillable = [
        'title',
        'city_id',
        'price',
    ];

    protected $casts = [
        'city_id' => 'integer',
        'price' => 'integer',
    ];

    public static function names(): Collection
    {
        return self::selectRaw('title, count("title")')
            ->groupBy('title')
            ->get()
            ->pluck('title');

    }
}

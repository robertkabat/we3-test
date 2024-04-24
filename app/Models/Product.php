<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeFilterBySku(Builder $query, $sku): Builder
    {
        return $query->where('sku', $sku);
    }

    public function scopeFilterByName(Builder $query, $name): Builder
    {
        return $query->where('name', $name);
    }
}

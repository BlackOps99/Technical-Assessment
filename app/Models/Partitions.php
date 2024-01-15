<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Items;

class Partitions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'cat_id'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class, 'cat_id');
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Items::class, 'partition_id');
    }

    public function scopeWithAll($query)
    {
        $query->with(['category', 'items']);
    }

    public function scopeWithOutAll($query)
    {
        $query->without(['category', 'items']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partitions;
use App\Models\Items;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar'
    ];

    public function partitions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Partitions::class, 'cat_id', 'id');
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Items::class, 'cat_id', 'id');
    }

    public function scopeWithAll($query)
    {
        $query->with(['partitions', 'items']);
    }

    public function scopeWithOutAll($query)
    {
        $query->without(['partitions', 'items']);
    }
}

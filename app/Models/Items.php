<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Partitions;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'cat_id',
        'partition_id'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class, 'cat_id');
    }

    public function partition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Partitions::class, 'partition_id');
    }

    public function scopeWithAll($query)
    {
        $query->with(['category', 'partition']);
    }

    public function scopeWithOutAll($query)
    {
        $query->without(['category', 'partition']);
    }
}

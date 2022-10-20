<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'status',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}

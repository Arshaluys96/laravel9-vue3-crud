<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

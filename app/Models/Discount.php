<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    protected $table = "discounts";

    protected $fillable = [
        "id",
        "codigo",
        "percentual"
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'cupom_desconto');
    }
}

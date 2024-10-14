<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    use HasFactory;

    protected $table = "sales_itens";

    protected $fillable = [
        "id",
        "venda_id", // (FK para sales)
        "produto_id", // (FK para products)
        "quantidade",
        "preco_unitario",
        "subtotal"
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        "id",
        "nome",
        "descricao",
        "preco_compra",
        "preco_venda",
        "categoria_id", // (FK para a tabela categorias)
        "quantidade_estoque",
        "imagem_url"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}

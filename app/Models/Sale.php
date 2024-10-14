<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $fillable = [
        "id",
        "cliente_id",
        "data_venda",
        "total_venda",
        "cupom_desconto",
        "total_final",
        "status"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'cupom_desconto')->withDefault();
    }

    public function saleEmails()
    {
        return $this->hasMany(SaleEmail::class);
    }
}

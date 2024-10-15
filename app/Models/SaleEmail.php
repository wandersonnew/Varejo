<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleEmail extends Model
{
    use HasFactory;

    protected $table = "sales_emails";

    protected $fillable = [
        "id",
        "venda_id",
        "email_cliente",
        "data_envio"
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

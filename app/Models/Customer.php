<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        "id",
        "nome",
        "cpf",
        "telefone",
        "email",
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

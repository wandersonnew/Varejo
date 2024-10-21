<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sale;

class CustomerController extends Controller
{
    public function checkOrderItems(int $saleid)
    {
        $saleInfo = Sale::leftJoin("sales_itens as si","si.venda_id","=","sl.id")
            ->leftJoin("products as p","p.id","=","si.produto_id")
            ->leftJoin("discounts as d","d.codigo","=","sl.cupom_desconto")
            ->from('sales as sl')
            ->where('sl.id', $saleid)
            ->select(
                'sl.data_venda', 'sl.total_venda', 'sl.cupom_desconto', 
                'sl.total_final', 'sl.total_final',
                'si.quantidade', 'si.preco_unitario', 'si.subtotal',
                'p.nome', 'p.descricao', 'p.imagem_url','d.percentual'
            )
            ->get();

        return response()->json([
            "saleinfo" => $saleInfo,
        ],200);
    }
}

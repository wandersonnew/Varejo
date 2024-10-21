<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\Discount;

it('Verifica se o retorno da API está correto', function () {
    $response = $this->getJson(route('checkorderitens', ['saleid' => 1]));

    
    $response->assertStatus(200)
        ->assertJsonStructure([
            'saleinfo' => [
                '*' => [
                    'data_venda',
                    'total_venda',
                    'cupom_desconto',
                    'total_final',
                    'quantidade',
                    'preco_unitario',
                    'subtotal',
                    'nome',
                    'descricao',
                    'imagem_url',
                    'percentual',
                ],
            ],
        ]);
});
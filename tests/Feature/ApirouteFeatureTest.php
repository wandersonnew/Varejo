<?php

test('Verifica se a rota da API está disponível', function () {
    $response = $this->get('/api/orderitens/2');

    $response->assertStatus(200);
});

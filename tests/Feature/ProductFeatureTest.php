<?php

test('Verifica se a rota está disponível', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

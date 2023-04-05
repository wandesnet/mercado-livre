<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use WandesCardoso\MercadoLivre\Meli;

it('can get user me', function () {
    $mockClient = new MockClient([
        MockResponse::make(['name' => 'Wandes'], 200),
    ]);

    $response = Meli::make()->request()->setMock($mockClient)->me(12332);

    expect($response)->toBeArray();
    expect($response['body']->name)->toEqual('Wandes');
    expect($response['httpCode'])->toEqual(200);
});

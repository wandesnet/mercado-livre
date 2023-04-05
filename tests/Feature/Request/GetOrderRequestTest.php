<?php

use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\GetOrderRequest;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

it('can request get order', function () {
    $mockClient = mockClient(['id' => 2000003508897196]);

    $response = Meli::make()->send(new GetOrderRequest(2000003508897196), $mockClient);

    $mockClient->assertSent(GetOrderRequest::class);

    $mockClient->assertSent('/orders/2000003508897196');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->id)->toEqual(2000003508897196);
    expect($response->status())->toEqual(200);
});

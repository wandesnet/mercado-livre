<?php

use Saloon\Contracts\Request;
use Saloon\Contracts\Response;
use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\GetOrdersRequest;

it('can request get all orders', function () {
    $mockClient = mockClient(['results' => [['id' => 2000003508897196]]]);

    $response = Meli::make()->send(new GetOrdersRequest(12332, 0, 50, [], 'recent', 'date_desc'), $mockClient);

    $mockClient->assertSent(GetOrdersRequest::class);

    $mockClient->assertSent('/orders/search');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->query()->isNotEmpty();
    });

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->results[0]->id)->toEqual(2000003508897196);
    expect($response->status())->toEqual(200);
});

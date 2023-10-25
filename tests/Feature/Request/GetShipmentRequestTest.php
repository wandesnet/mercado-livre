<?php

use Saloon\Http\Request;
use Saloon\Http\Response;
use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\GetRequest;

it('can request get shipment', function () {
    $mockClient = mockClient(['id' => 123456789]);

    $response = Meli::make()->send(new GetRequest('shipments/123456789', []), $mockClient);

    $mockClient->assertSent(GetRequest::class);

    $mockClient->assertSent('shipments/123456789');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->id)->toEqual(123456789);
    expect($response->status())->toEqual(200);
});

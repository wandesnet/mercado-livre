<?php

use Saloon\Http\Request;
use Saloon\Http\Response;
use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\GetPaymentRequest;

it('can request get payment', function () {
    $mockClient = mockClient(['id' => 123456789]);

    $response = Meli::make()->send(new GetPaymentRequest(123456789), $mockClient);

    $mockClient->assertSent(GetPaymentRequest::class);

    $mockClient->assertSent('/collections/123456789');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->id)->toEqual(123456789);
    expect($response->status())->toEqual(200);
});

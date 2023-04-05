<?php

use Saloon\Contracts\Request;
use Saloon\Contracts\Response;
use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\DeleteRequest;

it('can request delete', function () {
    $mockClient = mockClient(['id' => 123456789]);

    $response = Meli::make()->send(new DeleteRequest('item/123456789'), $mockClient);

    $mockClient->assertSent(DeleteRequest::class);

    $mockClient->assertSent('item/123456789');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'DELETE';
    });

    expect($response->object()->id)->toEqual(123456789);
    expect($response->status())->toEqual(200);
});

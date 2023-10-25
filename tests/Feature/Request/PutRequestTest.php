<?php

use Saloon\Http\Request;
use Saloon\Http\Response;
use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\PutRequest;

it('can request put', function () {
    $mockClient = mockClient(['id' => 123456789]);

    $response = Meli::make()->send(new PutRequest('item', [
        'id' => 123456789,
        'title' => 'Test',
        'category_id' => 'MLB1234',
    ]), $mockClient);

    $mockClient->assertSent(PutRequest::class);

    $mockClient->assertSent('item');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'PUT';
    });

    expect($response->object()->id)->toEqual(123456789);
    expect($response->status())->toEqual(200);
});

<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\GetUserMeRequest;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

it('request get user me', function () {
    $mockClient = new MockClient([
        MockResponse::make(['name' => 'Wandes'], 200),
    ]);

    $response = Meli::make()->send(new GetUserMeRequest(12332), $mockClient);

    $mockClient->assertSent(GetUserMeRequest::class);

    $mockClient->assertSent('/users/12332');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->name)->toEqual('Wandes');
    expect($response->status())->toEqual(200);
});

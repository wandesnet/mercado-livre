<?php

use WandesCardoso\MercadoLivre\Meli;
use WandesCardoso\MercadoLivre\Request\GetUserMeRequest;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

it('can request get user me', function () {
    $mockClient = mockClient(['name' => 'Wandes']);

    $response = Meli::make()->send(new GetUserMeRequest(12332), $mockClient);

    $mockClient->assertSent(GetUserMeRequest::class);

    $mockClient->assertSent('/users/12332');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->name)->toEqual('Wandes');
    expect($response->status())->toEqual(200);
});

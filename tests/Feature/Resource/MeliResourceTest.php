<?php

use WandesCardoso\MercadoLivre\Meli;

it('can get user me', function () {
    $mockClient = mockClient('me');

    $response = Meli::make()->withMockClient($mockClient)->request()->me(12332);

    expect($response)->toBeArray();
    expect($response['body']->first_name)->toEqual('Test');
    expect($response['httpCode'])->toEqual(200);
});

it('can get all orders', function () {
    $mockClient = mockClient('orders');

    $response = Meli::make()->withMockClient($mockClient)->request()->orders(12332);

    expect($response)->toBeArray();
    expect($response['body']->results[0]->status)->toEqual('paid');
    expect($response['httpCode'])->toEqual(200);
});

it('can get order', function () {
    $mockClient = mockClient('order');

    $response = Meli::make()->withMockClient($mockClient)->request()->order(2000003508897196);

    expect($response)->toBeArray();
    expect($response['body']->id)->toEqual(2000003508897196);
    expect($response['httpCode'])->toEqual(200);
});

it('can get shipment', function () {
    $mockClient = mockClient('shipment');

    $response = Meli::make()->withMockClient($mockClient)->request()->shipment(1234567889);

    expect($response)->toBeArray();
    expect($response['body']->id)->toEqual(1234567889);
    expect($response['httpCode'])->toEqual(200);
});

it('can get raw', function () {
    $mockClient = mockClient('shipment');

    $response = Meli::make()->withMockClient($mockClient)->request()->raw('shipments/1234567889/costs');

    expect($response)->toBeArray();
    expect($response['body']->id)->toEqual(1234567889);
    expect($response['httpCode'])->toEqual(200);
});

it('can post', function () {
    $mockClient = mockClient([
        'user_id' => 123456,
    ]);

    $response = Meli::make()->withMockClient($mockClient)->request()->post('users/5623456/questions_blacklist', [
        'user_id' => 123456,
    ]);

    expect($response)->toBeArray();
    expect($response['body']->user_id)->toEqual(123456);
    expect($response['httpCode'])->toEqual(200);
});

it('can delete', function () {
    $mockClient = mockClient([
        'user_id' => 3123456,
    ]);

    $response = Meli::make()->withMockClient($mockClient)->request()->delete('users/15623456/questions_blacklist/3123456');

    expect($response)->toBeArray();
    expect($response['body']->user_id)->toEqual(3123456);
    expect($response['httpCode'])->toEqual(200);
});

it('can get payment', function () {
    $mockClient = mockClient([
        'id' => 1234567890,
        'status' => 'approved',
    ]);

    $response = Meli::make()->withMockClient($mockClient)->request()->payment(1234567890);

    expect($response)->toBeArray();
    expect($response['body']->id)->toEqual(1234567890);
    expect($response['body']->status)->toEqual('approved');
    expect($response['httpCode'])->toEqual(200);
});

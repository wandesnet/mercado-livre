<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Resource;

use WandesCardoso\MercadoLivre\Request\PutRequest;
use WandesCardoso\MercadoLivre\Request\PostRequest;
use WandesCardoso\MercadoLivre\Request\DeleteRequest;
use WandesCardoso\MercadoLivre\Request\GetRawRequest;
use WandesCardoso\MercadoLivre\Request\GetOrderRequest;
use WandesCardoso\MercadoLivre\Request\GetOrdersRequest;
use WandesCardoso\MercadoLivre\Request\GetUserMeRequest;
use WandesCardoso\MercadoLivre\Request\GetPaymentRequest;
use WandesCardoso\MercadoLivre\Request\GetShipmentRequest;

class MeliResource extends Resource
{
    /** @return array <string, mixed> */
    public function me(?string $user_id = null): array
    {
        $response = $this->connector->send(new GetUserMeRequest($user_id));

        return [
            'body' => $response->object(),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param array<string, mixed> $params
     * @return array <string, mixed>
     */
    public function orders(int $seller_id, int $page = 0, int $perPage = 50, array $params = [], string $label = 'recent', string $sort = 'date_desc'): array
    {
        $response = $this->connector->send(new GetOrdersRequest($seller_id, $page, $perPage, $params, $label, $sort));

        return [
            'body' => $response->object(),
            'httpCode' => $response->status(),
        ];
    }

     /** @return array <string, mixed> */
    public function order(int $order_id): array
    {
        $response = $this->connector->send(new GetOrderRequest($order_id));

        return [
            'body' => $response->object(),
            'httpCode' => $response->status(),
        ];
    }

     /** @return array <string, mixed> */
    public function shipment(int $shipment_id): array
    {
        $response = $this->connector->send(new GetShipmentRequest($shipment_id));

        return [
            'body' => $response->object(),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param array<string, mixed> $params
     * @return array <string, mixed>
     * */
    public function raw(string $uri, $params = []): array
    {
        $response = $this->connector->send(new GetRawRequest($uri, $params));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

     /**
      * @param array<string, mixed> $data
      * @return array <string, mixed>
      * */
    public function post(string $uri, array $data): array
    {
        $response = $this->connector->send(new PostRequest($uri, $data));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @return array <string, mixed>
     * */
    public function put(string $uri, array $data): array
    {
        $response = $this->connector->send(new PutRequest($uri, $data));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

     /** @return array <string, mixed> */
    public function delete(string $uri): array
    {
        $response = $this->connector->send(new DeleteRequest($uri));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function payment(int $pay_id): array
    {
        $response = $this->connector->send(new GetPaymentRequest($pay_id));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }
}

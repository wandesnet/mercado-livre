<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Resource;

use Saloon\Contracts\MockClient;
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
    public function setMock(MockClient $mockClient = null): MeliResource
    {
        $this->mockClient = $mockClient;

        return $this;
    }

    /** @return array <string, mixed> */
    public function me(?string $user_id = null): array
    {
        $response = $this->connector->send(new GetUserMeRequest($user_id), $this->getMock());

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
        $response = $this->connector->send(new GetOrdersRequest($seller_id, $page, $perPage, $params, $label, $sort), $this->getMock());

        return [
            'body' => $response->object(),
            'httpCode' => $response->status(),
        ];
    }

     /** @return array <string, mixed> */
    public function order(int $order_id): array
    {
        $response = $this->connector->send(new GetOrderRequest($order_id), $this->getMock());

        return [
            'body' => $response->object(),
            'httpCode' => $response->status(),
        ];
    }

     /** @return array <string, mixed> */
    public function shipment(int $shipment_id): array
    {
        $response = $this->connector->send(new GetShipmentRequest($shipment_id), $this->getMock());

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
        $response = $this->connector->send(new GetRawRequest($uri, $params), $this->getMock());

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
        $response = $this->connector->send(new PostRequest($uri, $data), $this->getMock());

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
        $response = $this->connector->send(new PutRequest($uri, $data), $this->getMock());

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

     /** @return array <string, mixed> */
    public function delete(string $uri): array
    {
        $response = $this->connector->send(new DeleteRequest($uri), $this->getMock());

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function payment(int $pay_id): array
    {
        $response = $this->connector->send(new GetPaymentRequest($pay_id), $this->getMock());

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }
}

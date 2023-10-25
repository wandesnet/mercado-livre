<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Resource;

use Exception;
use Throwable;
use WandesCardoso\MercadoLivre\Request\GetRequest;
use WandesCardoso\MercadoLivre\Request\PutRequest;
use WandesCardoso\MercadoLivre\Request\PostRequest;
use WandesCardoso\MercadoLivre\Request\DeleteRequest;
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
        try {
            $response = $this->connector->send(new GetUserMeRequest($user_id));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

            return [
                'body' => json_decode($response->body()),
                'httpCode' => $response->status(),
            ];

    }

    /**
     * @param  array<string, mixed>  $params
     *
     * @return array <string, mixed>
     */
    public function orders(int $seller_id, int $page = 0, int $perPage = 50, array $params = [], string $label = 'recent', string $sort = 'date_desc'): array
    {
        try {
            $response = $this->connector->send(new GetOrdersRequest(
                $seller_id,
                $page,
                $perPage,
                $params,
                $label,
                $sort
            ));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function order(int $order_id): array
    {
        try {
            $response = $this->connector->send(new GetOrderRequest($order_id));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function shipment(int $shipment_id): array
    {
        try {
            $response
                = $this->connector->send(new GetShipmentRequest($shipment_id));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array <string, mixed>
     */
    public function get(string $uri, array $params = []): array
    {
        try {
            $response = $this->connector->send(new GetRequest($uri, $params));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array <string, mixed>
     */
    public function post(string $uri, array $data): array
    {
        try {
            $response = $this->connector->send(new PostRequest($uri, $data));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array <string, mixed>
     */
    public function put(string $uri, array $data): array
    {
        try {
            $response = $this->connector->send(new PutRequest($uri, $data));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function delete(string $uri): array
    {
        try {
            $response = $this->connector->send(new DeleteRequest($uri));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function payment(int $pay_id): array
    {
        try {
            $response = $this->connector->send(new GetPaymentRequest($pay_id));
        } catch (Throwable $e) {
            return $this->throwError($e);
        }

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array<string, mixed> */
    protected function throwError(Throwable|Exception $e): array
    {
        return [
            'body' => $e->getMessage(),
            'httpCode' => $e->getCode(),
        ];
    }
}

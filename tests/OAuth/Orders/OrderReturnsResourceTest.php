<?php

namespace OAuth\Orders;

use Piggy\Api\Tests\OAuthTestCase;

class OrderReturnsResourceTest extends OAuthTestCase
{
    /**
     * @test
     */
    public function it_can_create_order_returns(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'order' => [
                'uuid' => '123',
            ],
            'status' => 'COMPLETED',
            'line_item_returns' => [
                [
                    'uuid' => '123',
                    'line_item' => [
                        'uuid' => '123',
                    ],
                    'quantity' => 1,
                ]
            ],
            'sub_line_item_returns' => []
        ]);

        $return = $this->mockedClient->orderReturns->create([
            'external_identifier' => '123',
            'status' => 'COMPLETED',
            'order' => [
                'uuid' => '123',
            ],
            'line_items' => [
                [
                    'uuid' => '123',
                    'quantity' => 5,
                    'reason' => 'Broken item'
                ],
            ],
        ]);

        $this->assertEquals('123', $return->getUuid());
    }

    /**
     * @test
     */
    public function it_can_process_order_returns(): void
    {
        $this->addExpectedResponse([
            'type' => 'points_transaction',
            'data' => [
                'points' => 40,
                'new_balance' => 40,
            ],
        ]);

        $response = $this->mockedClient->orderReturns->process('123');

        $this->assertEquals(40,  $response->data->points);
        $this->assertEquals(40,  $response->data->new_balance);
    }

    /**
     * @test
     */
    public function it_can_create_and_process_order_returns(): void
    {
        $this->addExpectedResponse([
            'return' => [
                'uuid' => '123',
                'order' => [
                    'uuid' => '123',
                ],
                'status' => 'COMPLETED',
                'line_item_returns' => [
                    [
                        'uuid' => '123',
                        'line_item' => [
                            'uuid' => '123',
                        ],
                        'quantity' => 1,
                    ]
                ],
                'sub_line_item_returns' => []
            ],
            'result' => [
                'type' => 'points_transaction',
                'data' => [
                    'points' => 40,
                    'new_balance' => 40,
                ],
            ]
        ]);

        $response = $this->mockedClient->orderReturns->createAndProcess([
            'external_identifier' => '123',
            'status' => 'COMPLETED',
            'order' => [
                'uuid' => '123',
            ],
            'line_items' => [
                [
                    'uuid' => '123',
                    'quantity' => 5,
                    'reason' => 'Broken item'
                ],
            ],
        ]);

        $this->assertEquals('123', $response['return']->getUuid());
        $this->assertEquals(40,  $response['result']->data->points);
        $this->assertEquals(40,  $response['result']->data->new_balance);
    }
}
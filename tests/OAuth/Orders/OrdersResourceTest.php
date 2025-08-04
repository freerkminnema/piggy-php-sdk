<?php

namespace Piggy\Api\Tests\OAuth\Orders;

use Piggy\Api\Tests\OAuthTestCase;

class OrdersResourceTest extends OAuthTestCase
{
    /**
     * @test
     */
    public function it_can_list_orders(): void
    {
        $this->addExpectedResponse([
            [
                'uuid' => '123',
                'external_identifier' => '123',
                'reference' => '123',
                'status' => 'CREATED',
                'payment_status' => 'PAID',
                'total_order_amount' => 2500,
                'order_amount' => 3000,
                'formatted_total_order_amount' => '€ 30.00',
                'total_discount_amount' => 500,
                'total_charges_amount' => 1000,
                'currency' => 'EUR',
                'paid_at' => '2025-01-01',
                'completed_at' => '2025-01-01',
                'created_at' => '2025-01-01',
                'updated_at' => '2025-01-01',
                'contact' => [
                    'uuid' => '123',
                    'email' => 'customer@example.com',
                ],
                'business_profile' => [
                    'uuid' => '123',
                    'name' => 'Test Business',
                ],
                'line_items' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'name' => 'Lungo',
                        'quantity' => 5,
                        'price' => 600,
                        'total_amount' => 3000,
                        'discount_amount' => 0,
                        'product' => [
                            'external_identifier' => '123',
                            'name' => 'Lungo',
                        ],
                        'sub_line_items' => [
                            [
                                'uuid' => '123',
                                'external_identifier' => $uuid = '123',
                                'name' => 'Extra Cream',
                                'quantity' => 1,
                                'price' => 1000,
                                'total_amount' => 1000,
                                'discount_amount' => 0,
                                'product' => [
                                    'external_identifier' => '123',
                                    'name' => 'Extra Cream',
                                ],
                            ],
                        ],
                    ],
                ],
                'applied_discounts' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'type' => 'ABSOLUTE',
                        'value' => 20,
                        'name' => 'Summer Sale',
                        'amount' => 20,
                        'applied_to' => 'SUB_LINE_ITEMS',
                        'line_items' => [],
                        'sub_line_items' => [
                            [
                                'external_identifier' => $uuid,
                            ],
                        ],
                    ],
                ],
                'charges' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'type' => 'SERVICE_CHARGE',
                        'name' => 'Service charge',
                        'amount' => 1000,
                        'discount_amount' => 0,
                        'total_amount' => 1000,
                    ],
                ],
            ],
        ]);

        $orders = $this->mockedClient->orders->list();

        $order = $orders[0];

        $this->assertEquals('123', $order->getUuid());
        $this->assertEquals('123', $order->getExternalIdentifier());
        $this->assertEquals('123', $order->getReference());
        $this->assertEquals('CREATED', $order->getStatus());
        $this->assertEquals('PAID', $order->getPaymentStatus());
        $this->assertEquals(2500, $order->getTotalOrderAmount());
        $this->assertEquals(3000, $order->getOrderAmount());
        $this->assertEquals('€ 30.00', $order->getFormattedTotalOrderAmount());
        $this->assertEquals(500, $order->getTotalDiscountAmount());
        $this->assertEquals(1000, $order->getTotalChargesAmount());
        $this->assertEquals('EUR', $order->getCurrency());
        $this->assertEquals('2025-01-01', $order->getPaidAt());
        $this->assertEquals('2025-01-01', $order->getCompletedAt());
        $this->assertEquals('2025-01-01', $order->getCreatedAt());
        $this->assertEquals('2025-01-01', $order->getUpdatedAt());

        $contact = $order->getContact();
        $this->assertEquals('123', $contact->getUuid());
        $this->assertEquals('customer@example.com', $contact->getEmail());

        $profile = $order->getShop();
        $this->assertEquals('123', $profile->getUuid());
        $this->assertEquals('Test Business', $profile->getName());

        $lineItems = $order->getLineItems();
        $this->assertCount(1, $lineItems);
        $lineItem = $lineItems[0];
        $this->assertEquals('123', $lineItem->getUuid());
        $this->assertEquals('123', $lineItem->getExternalIdentifier());
        $this->assertEquals('Lungo', $lineItem->getName());
        $this->assertEquals(5, $lineItem->getQuantity());
        $this->assertEquals(600, $lineItem->getPrice());
        $this->assertEquals(3000, $lineItem->getTotalAmount());
        $this->assertEquals(0, $lineItem->getDiscountAmount());

        $product = $lineItem->getProduct();
        $this->assertEquals('123', $product->getExternalIdentifier());
        $this->assertEquals('Lungo', $product->getName());

        $subLineItems = $lineItem->getSubLineItems();
        $this->assertCount(1, $subLineItems);
        $subLineItem = $subLineItems[0];
        $this->assertEquals('123', $subLineItem->getUuid());
        $this->assertEquals('123', $subLineItem->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subLineItem->getName());
        $this->assertEquals(1, $subLineItem->getQuantity());
        $this->assertEquals(1000, $subLineItem->getPrice());
        $this->assertEquals(1000, $subLineItem->getTotalAmount());
        $this->assertEquals(0, $subLineItem->getDiscountAmount());

        $subProduct = $subLineItem->getProduct();
        $this->assertEquals('123', $subProduct->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subProduct->getName());

        $discounts = $order->getAppliedDiscounts();
        $this->assertCount(1, $discounts);
        $discount = $discounts[0];
        $this->assertEquals('123', $discount->getExternalIdentifier());
        $this->assertEquals('ABSOLUTE', $discount->getType());
        $this->assertEquals('Summer Sale', $discount->getName());
        $this->assertEquals(20, $discount->getAmount());
        $this->assertEquals('SUB_LINE_ITEMS', $discount->getAppliedTo());
        $this->assertEquals('123', $discount->getSubLineItems()[0]->external_identifier);

        $charges = $order->getCharges();
        $this->assertCount(1, $charges);
        $charge = $charges[0];
        $this->assertEquals('123', $charge->getExternalIdentifier());
        $this->assertEquals('SERVICE_CHARGE', $charge->getType());
        $this->assertEquals('Service charge', $charge->getName());
        $this->assertEquals(1000, $charge->getAmount());
        $this->assertEquals(0, $charge->getDiscountAmount());
        $this->assertEquals(1000, $charge->getTotalAmount());
    }

    /**
     * @test
     */
    public function it_can_get_an_order(): void
    {

        $this->addExpectedResponse([
                'uuid' => '123',
                'external_identifier' => '123',
                'reference' => '123',
                'status' => 'CREATED',
                'payment_status' => 'PAID',
                'total_order_amount' => 2500,
                'order_amount' => 3000,
                'formatted_total_order_amount' => '€ 30.00',
                'total_discount_amount' => 500,
                'total_charges_amount' => 1000,
                'currency' => 'EUR',
                'paid_at' => '2025-01-01',
                'completed_at' => '2025-01-01',
                'created_at' => '2025-01-01',
                'updated_at' => '2025-01-01',
                'contact' => [
                    'uuid' => '123',
                    'email' => 'customer@example.com',
                ],
                'business_profile' => [
                    'uuid' => '123',
                    'name' => 'Test Business',
                ],
                'line_items' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'name' => 'Lungo',
                        'quantity' => 5,
                        'price' => 600,
                        'total_amount' => 3000,
                        'discount_amount' => 0,
                        'product' => [
                            'external_identifier' => '123',
                            'name' => 'Lungo',
                        ],
                        'sub_line_items' => [
                            [
                                'uuid' => '123',
                                'external_identifier' => $uuid = '123',
                                'name' => 'Extra Cream',
                                'quantity' => 1,
                                'price' => 1000,
                                'total_amount' => 1000,
                                'discount_amount' => 0,
                                'product' => [
                                    'external_identifier' => '123',
                                    'name' => 'Extra Cream',
                                ],
                            ],
                        ],
                    ],
                ],
                'applied_discounts' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'type' => 'ABSOLUTE',
                        'value' => 20,
                        'name' => 'Summer Sale',
                        'amount' => 20,
                        'applied_to' => 'SUB_LINE_ITEMS',
                        'line_items' => [],
                        'sub_line_items' => [
                            [
                                'external_identifier' => $uuid,
                            ],
                        ],
                    ],
                ],
                'charges' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'type' => 'SERVICE_CHARGE',
                        'name' => 'Service charge',
                        'amount' => 1000,
                        'discount_amount' => 0,
                        'total_amount' => 1000,
                    ],
                ],
        ]);

        $order = $this->mockedClient->orders->get('123');

        $this->assertEquals('123', $order->getUuid());
        $this->assertEquals('123', $order->getExternalIdentifier());
        $this->assertEquals('123', $order->getReference());
        $this->assertEquals('CREATED', $order->getStatus());
        $this->assertEquals('PAID', $order->getPaymentStatus());
        $this->assertEquals(2500, $order->getTotalOrderAmount());
        $this->assertEquals(3000, $order->getOrderAmount());
        $this->assertEquals('€ 30.00', $order->getFormattedTotalOrderAmount());
        $this->assertEquals(500, $order->getTotalDiscountAmount());
        $this->assertEquals(1000, $order->getTotalChargesAmount());
        $this->assertEquals('EUR', $order->getCurrency());
        $this->assertEquals('2025-01-01', $order->getPaidAt());
        $this->assertEquals('2025-01-01', $order->getCompletedAt());
        $this->assertEquals('2025-01-01', $order->getCreatedAt());
        $this->assertEquals('2025-01-01', $order->getUpdatedAt());

        $contact = $order->getContact();
        $this->assertEquals('123', $contact->getUuid());
        $this->assertEquals('customer@example.com', $contact->getEmail());

        $profile = $order->getShop();
        $this->assertEquals('123', $profile->getUuid());
        $this->assertEquals('Test Business', $profile->getName());

        $lineItems = $order->getLineItems();
        $this->assertCount(1, $lineItems);
        $lineItem = $lineItems[0];
        $this->assertEquals('123', $lineItem->getUuid());
        $this->assertEquals('123', $lineItem->getExternalIdentifier());
        $this->assertEquals('Lungo', $lineItem->getName());
        $this->assertEquals(5, $lineItem->getQuantity());
        $this->assertEquals(600, $lineItem->getPrice());
        $this->assertEquals(3000, $lineItem->getTotalAmount());
        $this->assertEquals(0, $lineItem->getDiscountAmount());

        $product = $lineItem->getProduct();
        $this->assertEquals('123', $product->getExternalIdentifier());
        $this->assertEquals('Lungo', $product->getName());

        $subLineItems = $lineItem->getSubLineItems();
        $this->assertCount(1, $subLineItems);
        $subLineItem = $subLineItems[0];
        $this->assertEquals('123', $subLineItem->getUuid());
        $this->assertEquals('123', $subLineItem->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subLineItem->getName());
        $this->assertEquals(1, $subLineItem->getQuantity());
        $this->assertEquals(1000, $subLineItem->getPrice());
        $this->assertEquals(1000, $subLineItem->getTotalAmount());
        $this->assertEquals(0, $subLineItem->getDiscountAmount());

        $subProduct = $subLineItem->getProduct();
        $this->assertEquals('123', $subProduct->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subProduct->getName());

        $discounts = $order->getAppliedDiscounts();
        $this->assertCount(1, $discounts);
        $discount = $discounts[0];
        $this->assertEquals('123', $discount->getExternalIdentifier());
        $this->assertEquals('ABSOLUTE', $discount->getType());
        $this->assertEquals('Summer Sale', $discount->getName());
        $this->assertEquals(20, $discount->getAmount());
        $this->assertEquals('SUB_LINE_ITEMS', $discount->getAppliedTo());
        $this->assertEquals('123', $discount->getSubLineItems()[0]->external_identifier);

        $charges = $order->getCharges();
        $this->assertCount(1, $charges);
        $charge = $charges[0];
        $this->assertEquals('123', $charge->getExternalIdentifier());
        $this->assertEquals('SERVICE_CHARGE', $charge->getType());
        $this->assertEquals('Service charge', $charge->getName());
        $this->assertEquals(1000, $charge->getAmount());
        $this->assertEquals(0, $charge->getDiscountAmount());
        $this->assertEquals(1000, $charge->getTotalAmount());
    }

    /**
     * @test
     */
    public function it_can_find_an_order(): void
    {

        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'reference' => '123',
            'status' => 'CREATED',
            'payment_status' => 'PAID',
            'total_order_amount' => 2500,
            'order_amount' => 3000,
            'formatted_total_order_amount' => '€ 30.00',
            'total_discount_amount' => 500,
            'total_charges_amount' => 1000,
            'currency' => 'EUR',
            'paid_at' => '2025-01-01',
            'completed_at' => '2025-01-01',
            'created_at' => '2025-01-01',
            'updated_at' => '2025-01-01',
            'contact' => [
                'uuid' => '123',
                'email' => 'customer@example.com',
            ],
            'business_profile' => [
                'uuid' => '123',
                'name' => 'Test Business',
            ],
            'line_items' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Lungo',
                    'quantity' => 5,
                    'price' => 600,
                    'total_amount' => 3000,
                    'discount_amount' => 0,
                    'product' => [
                        'external_identifier' => '123',
                        'name' => 'Lungo',
                    ],
                    'sub_line_items' => [
                        [
                            'uuid' => '123',
                            'external_identifier' => $uuid = '123',
                            'name' => 'Extra Cream',
                            'quantity' => 1,
                            'price' => 1000,
                            'total_amount' => 1000,
                            'discount_amount' => 0,
                            'product' => [
                                'external_identifier' => '123',
                                'name' => 'Extra Cream',
                            ],
                        ],
                    ],
                ],
            ],
            'applied_discounts' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'type' => 'ABSOLUTE',
                    'value' => 20,
                    'name' => 'Summer Sale',
                    'amount' => 20,
                    'applied_to' => 'SUB_LINE_ITEMS',
                    'line_items' => [],
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid,
                        ],
                    ],
                ],
            ],
            'charges' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'type' => 'SERVICE_CHARGE',
                    'name' => 'Service charge',
                    'amount' => 1000,
                    'discount_amount' => 0,
                    'total_amount' => 1000,
                ],
            ],
        ]);

        $order = $this->mockedClient->orders->find([
            'external_identifier' => '123',
        ]);

        $this->assertEquals('123', $order->getUuid());
        $this->assertEquals('123', $order->getExternalIdentifier());
        $this->assertEquals('123', $order->getReference());
        $this->assertEquals('CREATED', $order->getStatus());
        $this->assertEquals('PAID', $order->getPaymentStatus());
        $this->assertEquals(2500, $order->getTotalOrderAmount());
        $this->assertEquals(3000, $order->getOrderAmount());
        $this->assertEquals('€ 30.00', $order->getFormattedTotalOrderAmount());
        $this->assertEquals(500, $order->getTotalDiscountAmount());
        $this->assertEquals(1000, $order->getTotalChargesAmount());
        $this->assertEquals('EUR', $order->getCurrency());
        $this->assertEquals('2025-01-01', $order->getPaidAt());
        $this->assertEquals('2025-01-01', $order->getCompletedAt());
        $this->assertEquals('2025-01-01', $order->getCreatedAt());
        $this->assertEquals('2025-01-01', $order->getUpdatedAt());

        $contact = $order->getContact();
        $this->assertEquals('123', $contact->getUuid());
        $this->assertEquals('customer@example.com', $contact->getEmail());

        $profile = $order->getShop();
        $this->assertEquals('123', $profile->getUuid());
        $this->assertEquals('Test Business', $profile->getName());

        $lineItems = $order->getLineItems();
        $this->assertCount(1, $lineItems);
        $lineItem = $lineItems[0];
        $this->assertEquals('123', $lineItem->getUuid());
        $this->assertEquals('123', $lineItem->getExternalIdentifier());
        $this->assertEquals('Lungo', $lineItem->getName());
        $this->assertEquals(5, $lineItem->getQuantity());
        $this->assertEquals(600, $lineItem->getPrice());
        $this->assertEquals(3000, $lineItem->getTotalAmount());
        $this->assertEquals(0, $lineItem->getDiscountAmount());

        $product = $lineItem->getProduct();
        $this->assertEquals('123', $product->getExternalIdentifier());
        $this->assertEquals('Lungo', $product->getName());

        $subLineItems = $lineItem->getSubLineItems();
        $this->assertCount(1, $subLineItems);
        $subLineItem = $subLineItems[0];
        $this->assertEquals('123', $subLineItem->getUuid());
        $this->assertEquals('123', $subLineItem->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subLineItem->getName());
        $this->assertEquals(1, $subLineItem->getQuantity());
        $this->assertEquals(1000, $subLineItem->getPrice());
        $this->assertEquals(1000, $subLineItem->getTotalAmount());
        $this->assertEquals(0, $subLineItem->getDiscountAmount());

        $subProduct = $subLineItem->getProduct();
        $this->assertEquals('123', $subProduct->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subProduct->getName());

        $discounts = $order->getAppliedDiscounts();
        $this->assertCount(1, $discounts);
        $discount = $discounts[0];
        $this->assertEquals('123', $discount->getExternalIdentifier());
        $this->assertEquals('ABSOLUTE', $discount->getType());
        $this->assertEquals('Summer Sale', $discount->getName());
        $this->assertEquals(20, $discount->getAmount());
        $this->assertEquals('SUB_LINE_ITEMS', $discount->getAppliedTo());
        $this->assertEquals('123', $discount->getSubLineItems()[0]->external_identifier);

        $charges = $order->getCharges();
        $this->assertCount(1, $charges);
        $charge = $charges[0];
        $this->assertEquals('123', $charge->getExternalIdentifier());
        $this->assertEquals('SERVICE_CHARGE', $charge->getType());
        $this->assertEquals('Service charge', $charge->getName());
        $this->assertEquals(1000, $charge->getAmount());
        $this->assertEquals(0, $charge->getDiscountAmount());
        $this->assertEquals(1000, $charge->getTotalAmount());
    }

    /**
     * @test
     */
    public function it_can_create_orders(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'reference' => '123',
            'status' => 'CREATED',
            'payment_status' => 'PAID',
            'total_order_amount' => 2500,
            'order_amount' => 3000,
            'formatted_total_order_amount' => '€ 30.00',
            'total_discount_amount' => 500,
            'total_charges_amount' => 1000,
            'currency' => 'EUR',
            'paid_at' => '2025-01-01',
            'completed_at' => '2025-01-01',
            'created_at' => '2025-01-01',
            'updated_at' => '2025-01-01',
            'contact' => [
                'uuid' => '123',
                'email' => 'customer@example.com',
            ],
            'business_profile' => [
                'uuid' => '123',
                'name' => 'Test Business',
            ],
            'line_items' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Lungo',
                    'quantity' => 5,
                    'price' => 600,
                    'total_amount' => 3000,
                    'discount_amount' => 0,
                    'product' => [
                        'external_identifier' => '123',
                        'name' => 'Lungo',
                    ],
                    'sub_line_items' => [
                        [
                            'uuid' => '123',
                            'external_identifier' => $uuid = '123',
                            'name' => 'Extra Cream',
                            'quantity' => 1,
                            'price' => 1000,
                            'total_amount' => 1000,
                            'discount_amount' => 0,
                            'product' => [
                                'external_identifier' => '123',
                                'name' => 'Extra Cream',
                            ],
                        ],
                    ],
                ],
            ],
            'applied_discounts' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'type' => 'ABSOLUTE',
                    'value' => 20,
                    'name' => 'Summer Sale',
                    'amount' => 20,
                    'applied_to' => 'SUB_LINE_ITEMS',
                    'line_items' => [],
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid,
                        ],
                    ],
                ],
            ],
            'charges' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'type' => 'SERVICE_CHARGE',
                    'name' => 'Service charge',
                    'amount' => 1000,
                    'discount_amount' => 0,
                    'total_amount' => 1000,
                ],
            ],
        ]);

        $order = $this->mockedClient->orders->create([
            'external_identifier' => '123',
            'reference' => '123',
            'status' => 'CREATED',
            'payment_status' => 'PAID',
            'total_order_amount' => 2500,
            'order_amount' => 3000,
            'total_discount_amount' => 500,
            'currency' => 'EUR',
            'paid_at' => '2025-01-01',
            'completed_at' => '2025-01-01',
            'contact' => [
                'uuid' => '123',
            ],
            'business_profile' => [
                'uuid' => '123',
            ],
            'line_items' => [
                [
                    'external_identifier' => '123',
                    'name' => 'Lungo',
                    'quantity' => 5,
                    'price' => 600,
                    'total_amount' => 3000,
                    'discount_amount' => 0,
                    'product' => [
                        'external_identifier' => '123',
                    ],
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid = '123',
                            'name' => 'Extra cream',
                            'quantity' => 1,
                            'price' => 1000,
                            'total_amount' => 1000,
                            'discount_amount' => 0,
                            'product' => [
                                'external_identifier' => '123',
                            ],
                        ],
                    ],
                ],
            ],
            'applied_discounts' => [
                [
                    'external_identifier' => '123',
                    'type' => 'ABSOLUTE',
                    'name' => 'Summer Sale',
                    'amount' => 20,
                    'applied_to' => 'SUB_LINE_ITEMS',
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid,
                        ],
                    ],
                ],
            ],
            'charges' => [
                [
                    'external_identifier' => '123',
                    'type' => 'SERVICE_CHARGE',
                    'name' => 'Service charge',
                    'amount' => 1000,
                    'discount_amount' => 0,
                    'total_amount' => 1000,
                ],
            ],
        ]);

        $this->assertEquals('123', $order->getUuid());
        $this->assertEquals('123', $order->getExternalIdentifier());
        $this->assertEquals('123', $order->getReference());
        $this->assertEquals('CREATED', $order->getStatus());
        $this->assertEquals('PAID', $order->getPaymentStatus());
        $this->assertEquals(2500, $order->getTotalOrderAmount());
        $this->assertEquals(3000, $order->getOrderAmount());
        $this->assertEquals('€ 30.00', $order->getFormattedTotalOrderAmount());
        $this->assertEquals(500, $order->getTotalDiscountAmount());
        $this->assertEquals(1000, $order->getTotalChargesAmount());
        $this->assertEquals('EUR', $order->getCurrency());
        $this->assertEquals('2025-01-01', $order->getPaidAt());
        $this->assertEquals('2025-01-01', $order->getCompletedAt());
        $this->assertEquals('2025-01-01', $order->getCreatedAt());
        $this->assertEquals('2025-01-01', $order->getUpdatedAt());

        $contact = $order->getContact();
        $this->assertEquals('123', $contact->getUuid());
        $this->assertEquals('customer@example.com', $contact->getEmail());

        $profile = $order->getShop();
        $this->assertEquals('123', $profile->getUuid());
        $this->assertEquals('Test Business', $profile->getName());

        $lineItems = $order->getLineItems();
        $this->assertCount(1, $lineItems);
        $lineItem = $lineItems[0];
        $this->assertEquals('123', $lineItem->getUuid());
        $this->assertEquals('123', $lineItem->getExternalIdentifier());
        $this->assertEquals('Lungo', $lineItem->getName());
        $this->assertEquals(5, $lineItem->getQuantity());
        $this->assertEquals(600, $lineItem->getPrice());
        $this->assertEquals(3000, $lineItem->getTotalAmount());
        $this->assertEquals(0, $lineItem->getDiscountAmount());

        $product = $lineItem->getProduct();
        $this->assertEquals('123', $product->getExternalIdentifier());
        $this->assertEquals('Lungo', $product->getName());

        $subLineItems = $lineItem->getSubLineItems();
        $this->assertCount(1, $subLineItems);
        $subLineItem = $subLineItems[0];
        $this->assertEquals('123', $subLineItem->getUuid());
        $this->assertEquals('123', $subLineItem->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subLineItem->getName());
        $this->assertEquals(1, $subLineItem->getQuantity());
        $this->assertEquals(1000, $subLineItem->getPrice());
        $this->assertEquals(1000, $subLineItem->getTotalAmount());
        $this->assertEquals(0, $subLineItem->getDiscountAmount());

        $subProduct = $subLineItem->getProduct();
        $this->assertEquals('123', $subProduct->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subProduct->getName());

        $discounts = $order->getAppliedDiscounts();
        $this->assertCount(1, $discounts);
        $discount = $discounts[0];
        $this->assertEquals('123', $discount->getExternalIdentifier());
        $this->assertEquals('ABSOLUTE', $discount->getType());
        $this->assertEquals('Summer Sale', $discount->getName());
        $this->assertEquals(20, $discount->getAmount());
        $this->assertEquals('SUB_LINE_ITEMS', $discount->getAppliedTo());
        $this->assertEquals('123', $discount->getSubLineItems()[0]->external_identifier);

        $charges = $order->getCharges();
        $this->assertCount(1, $charges);
        $charge = $charges[0];
        $this->assertEquals('123', $charge->getExternalIdentifier());
        $this->assertEquals('SERVICE_CHARGE', $charge->getType());
        $this->assertEquals('Service charge', $charge->getName());
        $this->assertEquals(1000, $charge->getAmount());
        $this->assertEquals(0, $charge->getDiscountAmount());
        $this->assertEquals(1000, $charge->getTotalAmount());
    }

    /**
     * @test
     */
    public function it_can_process_orders(): void
    {
        $this->addExpectedResponse([
            'type' => 'points_transaction',
            'data' => [
                'points' => 40,
                'new_balance' => 40,
            ],
        ]);

        $response = $this->mockedClient->orders->process('123');

        $this->assertEquals(40,  $response->data->points);
        $this->assertEquals(40,  $response->data->new_balance);
    }

    /**
     * @test
     */
    public function it_can_create_and_process_orders(): void
    {
        $this->addExpectedResponse([
            'order' => [
                'uuid' => '123',
                'external_identifier' => '123',
                'reference' => '123',
                'status' => 'CREATED',
                'payment_status' => 'PAID',
                'total_order_amount' => 2500,
                'order_amount' => 3000,
                'formatted_total_order_amount' => '€ 30.00',
                'total_discount_amount' => 500,
                'total_charges_amount' => 1000,
                'currency' => 'EUR',
                'paid_at' => '2025-01-01',
                'completed_at' => '2025-01-01',
                'created_at' => '2025-01-01',
                'updated_at' => '2025-01-01',
                'contact' => [
                    'uuid' => '123',
                    'email' => 'customer@example.com',
                ],
                'business_profile' => [
                    'uuid' => '123',
                    'name' => 'Test Business',
                ],
                'line_items' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'name' => 'Lungo',
                        'quantity' => 5,
                        'price' => 600,
                        'total_amount' => 3000,
                        'discount_amount' => 0,
                        'product' => [
                            'external_identifier' => '123',
                            'name' => 'Lungo',
                        ],
                        'sub_line_items' => [
                            [
                                'uuid' => '123',
                                'external_identifier' => $uuid = '123',
                                'name' => 'Extra Cream',
                                'quantity' => 1,
                                'price' => 1000,
                                'total_amount' => 1000,
                                'discount_amount' => 0,
                                'product' => [
                                    'external_identifier' => '123',
                                    'name' => 'Extra Cream',
                                ],
                            ],
                        ],
                    ],
                ],
                'applied_discounts' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'type' => 'ABSOLUTE',
                        'value' => 20,
                        'name' => 'Summer Sale',
                        'amount' => 20,
                        'applied_to' => 'SUB_LINE_ITEMS',
                        'line_items' => [],
                        'sub_line_items' => [
                            [
                                'external_identifier' => $uuid,
                            ],
                        ],
                    ],
                ],
                'charges' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'type' => 'SERVICE_CHARGE',
                        'name' => 'Service charge',
                        'amount' => 1000,
                        'discount_amount' => 0,
                        'total_amount' => 1000,
                    ],
                ],
            ],
            'result' => [
                'type' => 'points_transaction',
                'data' => [
                    'points' => 40,
                    'new_balance' => 40,
                ],
            ],
        ]);

        $response = $this->mockedClient->orders->createAndProcess([
            'external_identifier' => '123',
            'reference' => '123',
            'status' => 'CREATED',
            'payment_status' => 'PAID',
            'total_order_amount' => 2500,
            'order_amount' => 3000,
            'total_discount_amount' => 500,
            'currency' => 'EUR',
            'paid_at' => '2025-01-01',
            'completed_at' => '2025-01-01',
            'contact' => [
                'uuid' => '123',
            ],
            'business_profile' => [
                'uuid' => '123',
            ],
            'line_items' => [
                [
                    'external_identifier' => '123',
                    'name' => 'Lungo',
                    'quantity' => 5,
                    'price' => 600,
                    'total_amount' => 3000,
                    'discount_amount' => 0,
                    'product' => [
                        'external_identifier' => '123',
                    ],
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid = '123',
                            'name' => 'Extra cream',
                            'quantity' => 1,
                            'price' => 1000,
                            'total_amount' => 1000,
                            'discount_amount' => 0,
                            'product' => [
                                'external_identifier' => '123',
                            ],
                        ],
                    ],
                ],
            ],
            'applied_discounts' => [
                [
                    'external_identifier' => '123',
                    'type' => 'ABSOLUTE',
                    'name' => 'Summer Sale',
                    'amount' => 20,
                    'applied_to' => 'SUB_LINE_ITEMS',
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid,
                        ],
                    ],
                ],
            ],
            'charges' => [
                [
                    'external_identifier' => '123',
                    'type' => 'SERVICE_CHARGE',
                    'name' => 'Service charge',
                    'amount' => 1000,
                    'discount_amount' => 0,
                    'total_amount' => 1000,
                ],
            ],
        ]);

        $order = $response['order'];

        $this->assertEquals('123', $order->getUuid());
        $this->assertEquals('123', $order->getExternalIdentifier());
        $this->assertEquals('123', $order->getReference());
        $this->assertEquals('CREATED', $order->getStatus());
        $this->assertEquals('PAID', $order->getPaymentStatus());
        $this->assertEquals(2500, $order->getTotalOrderAmount());
        $this->assertEquals(3000, $order->getOrderAmount());
        $this->assertEquals('€ 30.00', $order->getFormattedTotalOrderAmount());
        $this->assertEquals(500, $order->getTotalDiscountAmount());
        $this->assertEquals(1000, $order->getTotalChargesAmount());
        $this->assertEquals('EUR', $order->getCurrency());
        $this->assertEquals('2025-01-01', $order->getPaidAt());
        $this->assertEquals('2025-01-01', $order->getCompletedAt());
        $this->assertEquals('2025-01-01', $order->getCreatedAt());
        $this->assertEquals('2025-01-01', $order->getUpdatedAt());

        $contact = $order->getContact();
        $this->assertEquals('123', $contact->getUuid());
        $this->assertEquals('customer@example.com', $contact->getEmail());

        $profile = $order->getShop();
        $this->assertEquals('123', $profile->getUuid());
        $this->assertEquals('Test Business', $profile->getName());

        $lineItems = $order->getLineItems();
        $this->assertCount(1, $lineItems);
        $lineItem = $lineItems[0];
        $this->assertEquals('123', $lineItem->getUuid());
        $this->assertEquals('123', $lineItem->getExternalIdentifier());
        $this->assertEquals('Lungo', $lineItem->getName());
        $this->assertEquals(5, $lineItem->getQuantity());
        $this->assertEquals(600, $lineItem->getPrice());
        $this->assertEquals(3000, $lineItem->getTotalAmount());
        $this->assertEquals(0, $lineItem->getDiscountAmount());

        $product = $lineItem->getProduct();
        $this->assertEquals('123', $product->getExternalIdentifier());
        $this->assertEquals('Lungo', $product->getName());

        $subLineItems = $lineItem->getSubLineItems();
        $this->assertCount(1, $subLineItems);
        $subLineItem = $subLineItems[0];
        $this->assertEquals('123', $subLineItem->getUuid());
        $this->assertEquals('123', $subLineItem->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subLineItem->getName());
        $this->assertEquals(1, $subLineItem->getQuantity());
        $this->assertEquals(1000, $subLineItem->getPrice());
        $this->assertEquals(1000, $subLineItem->getTotalAmount());
        $this->assertEquals(0, $subLineItem->getDiscountAmount());

        $subProduct = $subLineItem->getProduct();
        $this->assertEquals('123', $subProduct->getExternalIdentifier());
        $this->assertEquals('Extra Cream', $subProduct->getName());

        $discounts = $order->getAppliedDiscounts();
        $this->assertCount(1, $discounts);
        $discount = $discounts[0];
        $this->assertEquals('123', $discount->getExternalIdentifier());
        $this->assertEquals('ABSOLUTE', $discount->getType());
        $this->assertEquals('Summer Sale', $discount->getName());
        $this->assertEquals(20, $discount->getAmount());
        $this->assertEquals('SUB_LINE_ITEMS', $discount->getAppliedTo());
        $this->assertEquals('123', $discount->getSubLineItems()[0]->external_identifier);

        $charges = $order->getCharges();
        $this->assertCount(1, $charges);
        $charge = $charges[0];
        $this->assertEquals('123', $charge->getExternalIdentifier());
        $this->assertEquals('SERVICE_CHARGE', $charge->getType());
        $this->assertEquals('Service charge', $charge->getName());
        $this->assertEquals(1000, $charge->getAmount());
        $this->assertEquals(0, $charge->getDiscountAmount());
        $this->assertEquals(1000, $charge->getTotalAmount());

        $result = $response['result'];

        $this->assertEquals(40,  $result->data->points);
        $this->assertEquals(40,  $result->data->new_balance);
    }

    /**
     * @test
     */
    public function it_can_calculate_orders(): void
    {
        $this->addExpectedResponse([
            'result' => [
                'type' => 'points_transaction',
                'data' => [
                    'points' => 40,
                    'new_balance' => 40,
                ],
            ],
        ]);

        $response = $this->mockedClient->orders->calculate([
            'external_identifier' => '123',
            'reference' => '123',
            'status' => 'CREATED',
            'payment_status' => 'PAID',
            'total_order_amount' => 2500,
            'order_amount' => 3000,
            'total_discount_amount' => 500,
            'currency' => 'EUR',
            'paid_at' => '2025-01-01',
            'completed_at' => '2025-01-01',
            'contact' => [
                'uuid' => '123',
            ],
            'business_profile' => [
                'uuid' => '123',
            ],
            'line_items' => [
                [
                    'external_identifier' => '123',
                    'name' => 'Lungo',
                    'quantity' => 5,
                    'price' => 600,
                    'total_amount' => 3000,
                    'discount_amount' => 0,
                    'product' => [
                        'external_identifier' => '123',
                    ],
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid = '123',
                            'name' => 'Extra cream',
                            'quantity' => 1,
                            'price' => 1000,
                            'total_amount' => 1000,
                            'discount_amount' => 0,
                            'product' => [
                                'external_identifier' => '123',
                            ],
                        ],
                    ],
                ],
            ],
            'applied_discounts' => [
                [
                    'external_identifier' => '123',
                    'type' => 'ABSOLUTE',
                    'name' => 'Summer Sale',
                    'amount' => 20,
                    'applied_to' => 'SUB_LINE_ITEMS',
                    'sub_line_items' => [
                        [
                            'external_identifier' => $uuid,
                        ],
                    ],
                ],
            ],
            'charges' => [
                [
                    'external_identifier' => '123',
                    'type' => 'SERVICE_CHARGE',
                    'name' => 'Service charge',
                    'amount' => 1000,
                    'discount_amount' => 0,
                    'total_amount' => 1000,
                ],
            ],
        ]);

        $this->assertEquals(40,  $response->result->data->points);
        $this->assertEquals(40,  $response->result->data->new_balance);
    }
}
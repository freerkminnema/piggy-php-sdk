<?php

namespace Piggy\Api\Tests\OAuth\Products;

use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Categories\Category;
use Piggy\Api\Tests\OAuthTestCase;

class ProductsResourceTest extends OAuthTestCase
{
    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_returns_a_list_of_products(): void
    {
        $this->addExpectedResponse([
            [
                'uuid' => '123',
                'external_identifier' => '123',
                'name' => 'Product 1 name',
                'description' => 'Product 1 description',
                'categories' => [
                    [
                        'uuid' => '123',
                        'external_identifier' => '123',
                        'name' => 'Category 1',
                    ]
                ]
            ],
            [
                'uuid' => '456',
                'external_identifier' => '456',
                'name' => 'Product 2 name',
                'description' => 'Product 2 description',
                'categories' => [
                    [
                        'uuid' => '456',
                        'external_identifier' => '456',
                        'name' => 'Category 2',
                    ]
                ]
            ],
        ]);

        $products = $this->mockedClient->products->list();

        $this->assertEquals('123', $products[0]->getUuid());
        $this->assertEquals('123', $products[0]->getExternalIdentifier());;
        $this->assertEquals('Product 1 name', $products[0]->getName());
        $this->assertEquals('Product 1 description', $products[0]->getDescription());
        $this->assertEquals([
            new Category('123', '123', 'Category 1'),
        ], $products[0]->getCategories());

        $this->assertEquals('456', $products[1]->getUuid());
        $this->assertEquals('456', $products[1]->getExternalIdentifier());;
        $this->assertEquals('Product 2 name', $products[1]->getName());
        $this->assertEquals('Product 2 description', $products[1]->getDescription());
        $this->assertEquals([
            new Category('456', '456', 'Category 2'),
        ], $products[1]->getCategories());
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_create_a_product(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'name' => 'Product 1 name',
            'description' => 'Product 1 description',
            'categories' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Category 1',
                ]
            ]
        ]);

        $product = $this->mockedClient->products->create(
            '123',
            'Product 1 name',
            'Product 1 description',
            [
                'external_identifier' => '123',
                'name' => 'Category 1',
            ]
        );

        $this->assertEquals('123', $product->getUuid());
        $this->assertEquals('123', $product->getExternalIdentifier());;
        $this->assertEquals('Product 1 name', $product->getName());
        $this->assertEquals('Product 1 description', $product->getDescription());
        $this->assertEquals([
            new Category('123', '123', 'Category 1'),
        ], $product->getCategories());
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_get_a_product(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'name' => 'Product 1 name',
            'description' => 'Product 1 description',
            'categories' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Category 1',
                ]
            ]
        ]);

        $product = $this->mockedClient->products->get('123');

        $this->assertEquals('123', $product->getUuid());
        $this->assertEquals('123', $product->getExternalIdentifier());;
        $this->assertEquals('Product 1 name', $product->getName());
        $this->assertEquals('Product 1 description', $product->getDescription());
        $this->assertEquals([
            new Category('123', '123', 'Category 1'),
        ], $product->getCategories());
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_find_a_product(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'name' => 'Product 1 name',
            'description' => 'Product 1 description',
            'categories' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Category 1',
                ]
            ]
        ]);

        $product = $this->mockedClient->products->find('123');

        $this->assertEquals('123', $product->getUuid());
        $this->assertEquals('123', $product->getExternalIdentifier());;
        $this->assertEquals('Product 1 name', $product->getName());
        $this->assertEquals('Product 1 description', $product->getDescription());
        $this->assertEquals([
            new Category('123', '123', 'Category 1'),
        ], $product->getCategories());
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_find_or_create_a_product(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'name' => 'Product 1 name',
            'description' => 'Product 1 description',
            'categories' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Category 1',
                ]
            ]
        ]);

        $product = $this->mockedClient->products->findOrCreate(
            '123',
            'Product 1 name',
            'Product 1 description',
            [
                'external_identifier' => '123',
                'name' => 'Category 1',
            ]
        );

        $this->assertEquals('123', $product->getUuid());
        $this->assertEquals('123', $product->getExternalIdentifier());;
        $this->assertEquals('Product 1 name', $product->getName());
        $this->assertEquals('Product 1 description', $product->getDescription());
        $this->assertEquals([
            new Category('123', '123', 'Category 1'),
        ], $product->getCategories());
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_update_a_product(): void
    {
        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'name' => 'Product 1 name',
            'description' => 'Product 1 description',
            'categories' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Category 1',
                ]
            ]
        ]);

        $product = $this->mockedClient->products->update(
            '123',
            '123',
            'Product 1 name',
            'Product 1 description',
            [
                'external_identifier' => '123',
                'name' => 'Category 1',
            ]
        );

        $this->assertEquals('123', $product->getUuid());
        $this->assertEquals('123', $product->getExternalIdentifier());;
        $this->assertEquals('Product 1 name', $product->getName());
        $this->assertEquals('Product 1 description', $product->getDescription());
        $this->assertEquals([
            new Category('123', '123', 'Category 1'),
        ], $product->getCategories());
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_delete_a_product(): void
    {
        $this->addExpectedResponse(null);

        $this->addExpectedResponse([
            'uuid' => '123',
            'external_identifier' => '123',
            'name' => 'Product 1 name',
            'description' => 'Product 1 description',
            'categories' => [
                [
                    'uuid' => '123',
                    'external_identifier' => '123',
                    'name' => 'Category 1',
                ]
            ]
        ]);

        $product = $this->mockedClient->products->delete('123');

        $this->assertNull($product);
    }

    /** @test
     *
     * @throws PiggyRequestException
     */
    public function it_can_batch_create_products(): void
    {
        $this->addExpectedResponse([
            'status' => 'processing',
        ]);

        $response = $this->mockedClient->products->batch([
            '456',
            '456',
            'Product 1 name',
            'Product 1 description',
            [
                'external_identifier' => '123',
                'name' => 'Category 1',
            ],
            '456',
            '456',
            'Product 2 name',
            'Product 2 description',
            [
                'external_identifier' => '456',
                'name' => 'Category 2',
            ]
        ]);

        $this->assertEquals('processing', $response->status);
    }
}
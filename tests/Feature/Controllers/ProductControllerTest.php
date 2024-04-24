<?php

namespace Tests\Feature\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_not_logged_in_user_cant_access_products(): void
    {
        // Make an unauthenticated request to the products endpoint
        $response = $this->json('GET', '/api/v1/products');

        // Assert that the response status code is 401 Unauthorized
        $response->assertStatus(401);
    }

    public function test_if_logged_in_user_can_retrieve_correct_products_response(): void
    {
        Product::factory(5)->create([
            'brand_id' => Brand::factory()->create()
        ]);
        Product::where('id', 1)->update(['name' => 'Homelander\'s cape']);

        $user = User::factory()->create([
            'email' => 'homelander@vought.us',
        ]);

        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/products');
        $responseData = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'brand_id',
                    'sku',
                    'name',
                    'price',
                    'description',
                    'created_at',
                    'updated_at'
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next'
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active'
                    ]
                ],
                'path',
                'per_page',
                'to',
                'total'
            ]
        ]);

        $this->assertCount(5, $responseData['data']);
        $this->assertEquals('Homelander\'s cape', $responseData['data'][0]['name']);
        $this->assertEquals(1, $responseData['meta']['current_page']);
    }
}

<?php

namespace Tests\Feature\Repositories;

use App\Models\Brand;
use App\Models\Product;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ProductsRepository $productsRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productsRepository = app(ProductsRepository::class);
    }

    public function test_if_can_retrieve_products(): void
    {
        Brand::factory(2)->create()->each(function ($brand) {
            Product::factory(5)->create([
                'brand_id' => $brand->id,
            ]);
        });

        $paginator = $this->productsRepository->getProducts();
        $products = $paginator->items();

        $this->assertCount('5', $products);
        $this->assertDatabaseCount('products', 10);
    }

    public function test_if_can_retrieve_filtered_products(): void
    {
        Brand::factory(2)->create()->each(function ($brand) {
            Product::factory(5)->create([
                'brand_id' => $brand->id,
            ]);
        });

        Product::factory()->create([
            'brand_id' => Brand::factory()->create()->id,
            'sku' => 'SKU0001',
            'name' => 'Dexter\'s knife set',
        ]);

        Product::factory()->create([
            'brand_id' => Brand::factory()->create()->id,
            'sku' => 'SKU0002',
            'name' => 'Homelander\'s cape',
        ]);

        $paginator = $this->productsRepository->getProducts(['name' => 'Homelander\'s cape']);
        $products = $paginator->items();

        $this->assertCount('1', $products);
        $this->assertEquals('Homelander\'s cape',array_pop($products)->name);
    }
}

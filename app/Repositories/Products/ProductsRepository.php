<?php

namespace App\Repositories\Products;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsRepository
{
    /**
     * Get products, optionally filtering by the provided filters.
     *
     * @param array{
     *      sku: int,
     *      name: int,
     *      perPage: int,
     *  } $filters An associative array containing:
     *    - 'sku': SKU of the product
     *    - 'name': Name of the product
     *    - 'perPage: int': number of products per page
     * @return LengthAwarePaginator Paginated collection of products.
     */
    public function getProducts(array $filters = []): LengthAwarePaginator
    {
        $query = Product::query();
        foreach ($filters as $filterName => $value) {
            $methodName = 'filterBy' . ucfirst($filterName);
            if (method_exists(Product::class, 'scope' . ucFirst($methodName))) {
                $value === null ? $query->$methodName() : $query->$methodName($value);
            }
        }

        return $query->paginate($filters['perPage'] ?? 5);
    }
}

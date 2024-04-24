<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Requests\GetProducts;
use App\Http\Resources\ProductsCollection;
use App\Repositories\Products\ProductsRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController
{
    public function __construct(private readonly ProductsRepository $productsRepository)
    {
    }

    public function index(GetProducts $request): ProductsCollection | JsonResponse
    {
        try {
            return new ProductsCollection($this->productsRepository->getProducts($request->all()));
        } catch (Exception $exception) {
            return response()->json([
                'filters' => $request->all(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
}

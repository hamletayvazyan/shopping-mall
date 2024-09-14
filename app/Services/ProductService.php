<?php

namespace App\Services;

use Illuminate\Support\Str;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        // for better use its recommended use pagination() insted of all().
        return $this->productRepository->all();
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data)
    {
        // making SKU dynamic is better solution if we should integrate with other servies
        $data['sku'] = $data['sku'] ?? $this->generateSKU();

        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->productRepository->find($id);

        $data['sku'] = $data['sku'] ?? $product->sku;

        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct($id)
    {
        $product = $this->productRepository->find($id);
        $this->productRepository->delete($product);
    }

    private function generateSKU()
    {
        return Str::upper(Str::random(8));
    }
}
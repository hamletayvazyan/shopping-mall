<?php

namespace App\Repositories;

use App\Models\Products;

class ProductRepository
{
    public function all()
    {
        return Products::with('category')->get();
    }

    public function find($id)
    {
        return Products::with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Products::create($data);
    }

    public function update(Products $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Products $product)
    {
        $product->delete();
    }
}
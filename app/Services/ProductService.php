<?php

namespace App\Services;


use App\Http\Resources\ProductResourse;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductService
{

    public function validateProduct(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'price' => ['required', 'numeric', 'min:1'],
        ];
        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function getProducts()
    {
        return ProductResourse::collection(Product::orderBy('id')->get());
    }

    public function getProduct($request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if ($product)
            return new ProductResourse($product);
        return null;
    }

    public function add($request)
    {
        $newProduct = new Product();
        $newProduct->name = $request->name;
        $newProduct->price = $request->price;
        $newProduct->save();

        return $newProduct;
    }

    public function edit($request)
    {
        $newProduct = Product::where('id', $request->product_id)->first();
        $newProduct->name = $request->name;
        $newProduct->price = $request->price;
        $newProduct->save();

        return $newProduct;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }
}

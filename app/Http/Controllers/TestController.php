<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('index');
    }


    /**
     * @param ProductService $productService
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getProducts(ProductService $productService)
    {
        return $productService->getProducts();
    }

    /**
     * @param ProductService $productService
     * @param Request $request
     * @return \App\Http\Resources\ProductResourse|null
     */
    public function getProduct(ProductService $productService, Request $request)
    {
        return $productService->getProduct($request);
    }

    /**
     * @param ProductService $productService
     * @param Request $request
     * @return \App\Models\Product|\Illuminate\Http\JsonResponse
     */
    public function add(ProductService $productService, Request $request)
    {
        $validator = $productService->validateProduct($request->all());
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 200);
        }

        return $productService->add($request);
    }

    /**
     * @param ProductService $productService
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(ProductService $productService, Request $request)
    {
        $validator = $productService->validateProduct($request->all());
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 200);
        }

        return $productService->edit($request);
    }

    /**
     * @param ProductService $productService
     * @param Request $request
     * @return \App\Models\Product
     */
    public function delete(ProductService $productService, Request $request)
    {
        return response()->json($productService->delete($request), 200);
    }

}

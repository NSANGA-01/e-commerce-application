<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AdminProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(): Response
    {
        return Inertia::render('Admin/Products/Index', [
            'products' => Product::latest()->paginate(10),
            'editingProduct' => null,
        ]);
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Admin/Products/Index', [
            'products' => Product::latest()->paginate(10),
            'editingProduct' => $product,
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $this->productService->create($request->validated());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->productService->update($product, $request->validated());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->delete($product);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

}

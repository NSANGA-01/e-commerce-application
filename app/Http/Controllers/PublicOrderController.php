<?php

namespace App\Http\Controllers;

use App\Data\Order\CheckoutOrderData;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;



class PublicOrderController extends Controller
{
    //

    public function __construct(
        protected OrderService $orderService
    ) {}

    public function catalog(): Response
    {
        $products = Product::where('is_active', true)
        ->latest()
        ->select('id', 'name', 'description', 'price', 'image', 'stock')
        ->paginate(9);

        return Inertia::render('Catalog/Index', [
            'products' => $products,
        ]);
    }




    public function checkout(CheckoutRequest $request): RedirectResponse
    {
        $order = $this->orderService->processGuestCheckout($request->validated());
        return redirect()->route('order.confirmation', ['orderNumber' => $order->order_number])
            ->with('success', 'Your order was placed successfully!');
    }



    public function confirmation(string $orderNumber): Response
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return Inertia::render('Catalog/Confirmation', [
            'order' => $order,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStatusRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AdminOrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    public function index(): Response
    {
        return Inertia::render('Admin/Orders/Index', [
            'orders' => Order::latest()->paginate(10),
            'selectedOrder' => null,
        ]);
    }

    public function show(Order $order): Response
    {
        return Inertia::render('Admin/Orders/Index', [
            'orders' => Order::latest()->paginate(10),
            'selectedOrder' => $order->load('orderItems.product'),
        ]);
    }

    public function updateStatus(OrderStatusRequest $request, Order $order): RedirectResponse
    {
        $this->orderService->updateStatus($order, $request->validated());

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }
}

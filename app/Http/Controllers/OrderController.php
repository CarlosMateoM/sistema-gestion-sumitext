<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {

        $orders = Order::with('customer')
            ->orderBy('created_at')
            ->filter(['search' => $request->search ])
            ->paginate(10);

        $customers = Customer::orderBy('created_at')
            ->filter(['search' => $request->searchCustomer ]) 
            ->take(5)
            ->get();

        return Inertia::render('Orders/OrdersView', [
            'orders' => $orders,
            'customers' => $customers,
            'filters' => $request->search
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $order = new Order();

        $order->customers_id = $request->input('customers_id');
        $order->observations = $request->input('observations');
        $order->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $order->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->back();
    }
}

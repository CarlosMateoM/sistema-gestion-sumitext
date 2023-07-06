<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with('customer')
            ->orderBy('created_at')
            ->filter(['search' => $request->search ])
            ->paginate(10);

        return Inertia::render('Production/ProductionView', [
            'orders' => $orders,
            'filters' => $request->search
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ImportService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('total_price', '>', 100);

        $financial_statuses = $query->pluck('financial_status')->filter()->unique()->values();

        if ($request->has('financial_status')) {
            if ($request->financial_status == 'null') {
                $query->whereNull('financial_status');
            } else {
                $query->where('financial_status', $request->financial_status);
            }
        }

        $orders = $query->paginate(5)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('orders.partials.list', compact('orders'))->render(),
                'pagination' => $orders->links()->toHtml(),
            ]);
        }

        return view('orders.index', compact('orders', 'financial_statuses'));
    }

    public function import()
    {
        ImportService::import();
        return redirect()->route('orders.index');
    }
}

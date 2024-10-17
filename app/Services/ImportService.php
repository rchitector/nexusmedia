<?php

namespace App\Services;


use App\Models\Order;
use Illuminate\Support\Facades\Http;

class ImportService
{

    public static function import(): void
    {
        $url = config('shopify.import_url');
        $response = Http::get($url);
        if ($response->successful()) {
            try {
                $orders = json_decode($response->body())->orders;
                Order::truncate();
                foreach ($orders as $order) {
                    if (isset($order->customer)) {
                        $o = new Order();
                        $o->customer_name = $order->customer->first_name.' '.$order->customer->last_name;
                        $o->customer_email = $order->customer->email;
                        $o->total_price = $order->total_price;
                        $o->financial_status = $order->financial_status;
                        $o->fulfillment_status = $order->fulfillment_status;
                        $o->save();
                    }
                }
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
        }
    }

}

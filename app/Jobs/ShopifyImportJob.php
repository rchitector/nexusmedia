<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Order;
use App\Services\ShopifyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ShopifyImportJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();
        Customer::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        ShopifyService::importCustomers();
        ShopifyService::importOrders();
    }
}

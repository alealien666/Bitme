<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Command;

class DeleteExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();
        $expiredOrders = Order::where('expired_at', '<=', $now)->get();

        foreach ($expiredOrders as $order) {
            if ($order->bukti_pembayaran === null) {
                $order->product()->detach();
                $order->delete();
            }
            foreach ($order->product as $product) {
                $masterProduct = Product::find($product->id);
                $masterProduct->update(['stok' => $masterProduct->stok + $product->pivot->jumlah_beli]);
            }
        }
    }
}

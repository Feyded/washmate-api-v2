<?php

namespace App\Services\Pos;

use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function create(array $data, $user): Order
    {
        return DB::transaction(function () use ($data, $user) {

            $services = $this->getServices($data);

            $orderSubtotal = 0;

            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'subtotal' => 0,
                'total' => 0,
                'status' => 'pending',
                'created_by' => $user->id,
            ]);

            foreach ($data['items'] as $item) {

                $service = $services[$item['service_id']];

                $orderItem = $order->items()->create([
                    'service_id' => $service->id,
                    'service_name' => $service->name,
                    'unit_price' => $service->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $service->price * $item['quantity'],
                ]);

                $orderSubtotal += $orderItem->subtotal;

                $this->processProducts(
                    $orderItem,
                    $service,
                    $item['products'] ?? []
                );
            }

            $order->update([
                'subtotal' => $orderSubtotal,
                'total' => $orderSubtotal,
            ]);

            return $order->load([
                'items.products',
            ]);
        });
    }

    private function getServices(array $data)
    {
        $serviceIds = collect($data['items'])
            ->pluck('service_id')
            ->unique();

        return Service::with([
            'products',
            'products.category',
        ])
            ->whereIn('id', $serviceIds)
            ->get()
            ->keyBy('id');
    }

    private function processProducts(
        $orderItem,
        Service $service,
        array $products
    ): void {
        // Product processing goes here.
    }

    private function generateOrderNumber(): string
    {
        return 'ORD-' . now()->format('YmdHis') . '-' . random_int(1000, 9999);
    }
}

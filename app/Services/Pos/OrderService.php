<?php

namespace App\Services\Pos;

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function create(array $data, User $user): Order
    {
        return DB::transaction(function () use ($data, $user) {

            $services = $this->getServices($data);

            $orderSubtotal = 0;

            $order = Order::create([
                'order_number' => null,
                'subtotal' => 0,
                'total' => 0,
                'status' => 'pending',
                'created_by' => $user->id,
            ]);

            $order->update([
                'order_number' => $this->generateOrderNumber($order),
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

    private function generateOrderNumber(Order $order): string
    {
        return sprintf(
            'ORD-%s-%06d',
            $order->created_at->format('Ymd'),
            $order->id
        );
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class cityOrdersReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'city' => $this->city,
            'total_of_orders' => $this->totalOfOrders,
            'number_of_orders' => $this->numberOfOrders,
            'number_of_items' => $this->itemsNumber(),
        ];
    }

    public function itemsNumber()
    {
        $orders = Order::where('city', $this->city)->get();
        $ss = 0;
        foreach ($orders as $order) {
            $ss = $ss + $order->detail->count();
        }

        return $ss;
    }
}

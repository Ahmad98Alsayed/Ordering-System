<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class userOrdersReportResource extends JsonResource
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
            'Customer' => User::where('id', $this->user_id)->first()->name,
            'total_of_orders' => $this->totalOfOrders,
            'number_of_orders' => $this->numberOfOrders,
            'city' => $this->city
        ];
    }
}

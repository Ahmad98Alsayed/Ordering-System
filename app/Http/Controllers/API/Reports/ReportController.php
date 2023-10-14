<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use App\Http\Resources\cityOrdersReportResource;
use App\Http\Resources\userOrdersReportResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function userOrdersReport(Request $request)
    {
        $month = $request->get('month');

        $orders = Order::select('user_id', 'city',DB::raw('count(*) as numberOfOrders'), DB::raw('sum(total) as totalOfOrders'))
            ->when($month, function ($query) use ($month) {
                $query = $query->whereMonth('created_at', $month);
            })
            ->groupBy('user_id', 'city')
            ->get();

        return userOrdersReportResource::collection($orders);
    }



    public function cityOrdersReport(Request $request)
    {
        $city = $request->get('city');

        $orders = Order::select('city', DB::raw('count(*) as numberOfOrders'), DB::raw('sum(total) as totalOfOrders'))
            ->when($city, function ($query) use ($city) {
                $query = $query->where('city', $city);
            })
            ->groupBy('city')
            ->get();

        return cityOrdersReportResource::collection($orders);
    }
}

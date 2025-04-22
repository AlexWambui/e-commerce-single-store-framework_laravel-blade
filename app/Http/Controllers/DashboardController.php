<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $count_users = User::count();
        $count_messages = Message::count();

         // Simulated monthly sales data
        $sales_data = collect(range(1, 12))->map(fn () => rand(2000, 12000));

        // Simulated city/location data
        $locations_labels = ['Nairobi', 'Mombasa', 'Kisumu', 'Eldoret', 'Nakuru'];
        $locations_orders = collect($locations_labels)->map(fn () => rand(5, 25));

        return view('dashboards.index', compact(
            'count_users',
            'count_messages',

            'sales_data',
            'locations_labels',
            'locations_orders',
        ));
    }
}

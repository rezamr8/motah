<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return view('admin.dashboard')
                ->with('orders_count',Order::all()->count())
                ->with('order_selesai',Order::where('status',1)->count())
                ->with('order_progress',Order::where('status',0)->count())
                ->with('total_modal', Order::all()->sum('modal'))
                ->with('sisa_modal', Order::all()->sum('sisa'));
    }
}

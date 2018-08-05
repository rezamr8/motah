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
        $from_date =  date("Y-m-01");
        $to_date = date("Y-m-t");
        
        return view('admin.dashboard')
                ->with('orders_count',Order::all()->count())
                ->with('order_selesai',Order::where('status',1)->count())
                ->with('order_progress',Order::where('status',0)->count())
                // ->with('total_modal', Order::all()->sum('modal'))
                ->with('total_modal',Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get()->sum('modal'))
                ->with('sisa_modal', Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get()->sum('sisa'));
    }
}

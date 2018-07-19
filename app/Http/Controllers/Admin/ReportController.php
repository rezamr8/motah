<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use App\Exports\OrderReport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    public function getTanggal(Request $request)
    {
        //dd($request->all());
        $from_date = $request->get('tgl_awal');
        $to_date = $request->get('tgl_akhir');

        $order = Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get();

        return view('admin.reports.datafilter',compact('order'));
    }

    public function exportOrder(Request $request,$type)
    {
        
        $from_date = $request->get('tgl_awal');
        $to_date = $request->get('tgl_akhir');
        if($from_date === null || $to_date === null ){
           
            return redirect()->back()->with('flash_message_danger','Tanggal Tidak Boleh Kosong');
        }
        $exportxls = Excel::create('Report-Transaksi', function($excel) use($from_date, $to_date) {

            $excel->sheet('Sheet1', function($sheet) use($from_date, $to_date) {
                $orders = Order::with('jenisorder')->whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get();

                $arr =array();
                foreach($orders as $order) {
                    //foreach($order->jenisorder as $js){
                        $data =  array($order->no_order, $order->jenisorder->jenis, $order->jumlah, $order->tgl_beres, 'Rp '.number_format($order->modal),
                           'Rp '.number_format($order->sisa));
                        array_push($arr, $data);
                   // }
                }

                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'No Order', 'Jenis Order', 'Jumlah', 'Tgl Beres', 'Modal',
                        'Sisa'
                    )

                );

            });

        })->export('xls');

        return $exportxls;
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}

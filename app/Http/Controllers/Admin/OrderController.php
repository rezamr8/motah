<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\JenisOrder;
use App\Barang;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $order = Order::where('jenis_order_id', 'LIKE', "%$keyword%")
                ->orWhere('jumlah', 'LIKE', "%$keyword%")
                ->orWhere('tgl_beres', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $order = Order::paginate($perPage);
        }

        
        return view('admin.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $jo = JenisOrder::pluck('nama_order','id');
        return view('admin.order.create')->with('jo',$jo);
    }

    public function orderTransaksi(Request $request, $id)
    {
        //dd(Auth::user()->id);
       // dd($request->all());

        // Find Order id
        $order = Order::find($id);
        $count = count($request['barang_id']);
        for($i = 0; $i < $count; $i++)
        {
            
            $barang_id = $request['barang_id'];
            $jumlah = $request['jumlah'];
             //save to relation has many
            $order->transaksi()->create([
                'barang_id'=>$barang_id[$i],
                'jumlah'=>$jumlah[$i]
                ]);
        }
       
        return redirect()->back()->with('flash_message','Bahan Telah Di tambahkan Ke Dalama Order');
        
    }

    public static function orderNumber()
    {
        // Get the last created order
        $lastOrder = \App\Order::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder )
         
            $number = 0;
        else 
            $number = substr($lastOrder->id, 0);
           // echo $number;

        
     
        return sprintf('%04d', intval($number) + 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // "jenis_order_id" => "3"
        // "jumlah" => "3"
        // "tgl_beres" => "2018/06/24"
        // "user_id" => "1"
        //dd($request->all());
        $ordernumber = OrderController::orderNumber();
        //dd($ordernumber);

        //dd($request['jenis_order_id']);
        $jo = $request['jenis_order_id'];
        $no_order = substr(JenisOrder::find($jo)->nama_order,0,3).date('Ymd').$ordernumber;

        $this->validate($request, [
			'jenis_order_id' => 'required',
			'jumlah' => 'required',
			'tgl_beres' => 'required',
			'user_id' => 'required'
		]);
        $requestData = array(
            'jenis_order_id' => $request['jenis_order_id'],
            'jumlah' => $request['jumlah'],
            'tgl_beres' => $request['tgl_beres'],
            'user_id' => $request['user_id'],
            'no_order' => $no_order
        );

        //dd($requestData);
        
        Order::create($requestData);

        return redirect('admin/order')->with('flash_message', 'Order added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $barang = Barang::pluck('nama_barang', 'id');
        $order = Order::with('transaksi')->find($id);
        return view('admin.order.show', compact('order','barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'jenis_order_id' => 'required',
			'jumlah' => 'required',
			'tgl_beres' => 'required',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        $order = Order::findOrFail($id);
        $order->update($requestData);

        return redirect('admin/order')->with('flash_message', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('admin/order')->with('flash_message', 'Order deleted!');
    }
}

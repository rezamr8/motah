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
use Yajra\Datatables\Datatables;

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
        $barang_id = $request['barang_id'];
        $jumlah = $request['jumlah'];
        $harga = $request['harga'];

        // cek bahan apakah sudah di input, lihat dari table transaksi
        $count = count($request['barang_id']);
        $order = Order::find($id);
        
        if($barang_id[0] == null)
        {
            return redirect()->back()->with('flash_message','Pilih Barang Terlebih Dahulu');
        }else{
            for($i = 0; $i < $count; $i++)
            {
                foreach($barang_id as $bi){
                    $transaksi = Transaksi::where('order_id', $id)->where('barang_id', $bi)->get();
                    
                    if($transaksi->isEmpty() == true)
                    {
                    
                            $order->transaksi()->create([
                                'barang_id'=>$barang_id[$i],
                                'jumlah'=>$jumlah[$i],
                                'harga' => $harga[$i]
                                ]);
                            //Pengurangan Stok
                            $b = Barang::find($barang_id[$i]);
                            $hasil = ($b->jumlah) - $jumlah[$i];
                            $b->jumlah = $hasil; 
                            $b->save();

                            //Pengurangan Modal di masukan ke dalam field sisa table order
                        return redirect()->back()->with('flash_message','Bahan Sudah di Tambahkan Ke dalam Order');
                    }else{
                        return redirect()->back()->with('flash_message','Bahan Sudah Ada');
                    }
                }
            }
            
        }
       
        
       
    }

    public static function orderNumber()
    {
       
        $lastOrder = \App\Order::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder )
         
            $number = 0;
        else 
            $number = substr($lastOrder->id, 0);
     
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
       
        $ordernumber = OrderController::orderNumber();
       
        $jo = $request['jenis_order_id'];
        $no_order = substr(JenisOrder::find($jo)->nama_order,0,3).date('Ymd').$ordernumber;

        $this->validate($request, [
			'jenis_order_id' => 'required',
			'jumlah' => 'required',
			'tgl_beres' => 'required',
            'user_id' => 'required',
            'modal' => 'required'
		]);
        $requestData = array(
            'jenis_order_id' => $request['jenis_order_id'],
            'jumlah' => $request['jumlah'],
            'tgl_beres' => $request['tgl_beres'],
            'user_id' => $request['user_id'],
            'no_order' => $no_order,
            'modal' => $request['modal']
        );

       
        
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
			
			'jumlah' => 'required',
			
			
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
        $o = Order::find($id);
        $o->transaksi()->delete();
        $o->delete();
        return redirect('admin/order')->with('flash_message', 'Order deleted!');
    }

    public function hapusOrderBarang($idOrder,$idBarang)
    {
        $transaksi = Transaksi::where('order_id',$idOrder)->where('barang_id',$idBarang)->first();
        $j = $transaksi->jumlah;
        $b = Barang::find($idBarang);
        $h = ($b->jumlah) + $j;
        $b->jumlah = $h;
        $b->save();
        $transaksi->delete();  
        return redirect()->back()->with('flash_message', 'Bahan Di delete!');
        
    }

    public function getMasterData()
    {
        $order = Order::with('jenisorder')->select();
        return Datatables::of($order)
            ->addColumn('details_url', function($user) {
                return url('admin/order/datadetail/' . $user->id);
            })
            ->addColumn('action', 'layouts.action')
            ->make(true);
    }
    public function getDetailsData($id)
    {
        $order = \App\Order::find($id)->transaksi()->with('barang');

        return Datatables::of($order)->make(true);
    }
}

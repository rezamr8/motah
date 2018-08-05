<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Estimasi;
use App\Order;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class EstimasiController extends Controller
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
            $estimasi = Order::where('status', 0)
                ->where(function($q) use ($keyword){
                    // global $keyword;
                    $q->where('no_order', 'LIKE', "%$keyword%")
                        ->orWhere('jumlah', 'LIKE', "%$keyword%")
                        ->orWhere('tgl_beres', 'LIKE', "%$keyword%");
                })       
                
                ->paginate($perPage);
        } else {
            $estimasi = Order::where('status', 0)->paginate($perPage);
        }
        //dd($estimasi);
        return view('admin.estimasi.index', compact('estimasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('estimasi.create');
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
        $this->validate($request, [
			'order_id' => 'required',
			'nama_barang' => 'required',
			'jumlah' => 'required',
			'harga' => 'required',
			'total_jumlah' => 'required',
			'total_harga' => 'required',
			'satuan' => 'required'
		]);
        $requestData = $request->all();
        
        Estimasi::create($requestData);

        return redirect('estimasi')->with('flash_message', 'Estimasi added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($estimasi)
    {
        $barang = Barang::pluck('nama_barang', 'id');
        $order = Order::with('estimasi')->find($estimasi);

        return view('admin.estimasi.show', compact('order','barang'));
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
        $estimasi = Estimasi::findOrFail($id);

        return view('estimasi.edit', compact('estimasi'));
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
			'order_id' => 'required',
			'nama_barang' => 'required',
			'jumlah' => 'required',
			'harga' => 'required',
			'total_jumlah' => 'required',
			'total_harga' => 'required',
			'satuan' => 'required'
		]);
        $requestData = $request->all();
        
        $estimasi = Estimasi::findOrFail($id);
        $estimasi->update($requestData);

        return redirect('estimasi')->with('flash_message', 'Estimasi updated!');
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
        Estimasi::destroy($id);

        return redirect('estimasi')->with('flash_message', 'Estimasi deleted!');
    }

    public function orderEstimasi(Request $request, $id)
    {
        //dd($request->all());
        $user = Auth::id();
        $harga = intval(preg_replace('/[^0-9]/', '', $request['harga'][0]));
        $totalharga = intval(preg_replace('/[^0-9]/', '',$request['totalharga'][0]));
        //dd($totalharga);
        $barang_id = $request->barang_id;
        $jumlah = $request['jumlah'];
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
                    $estimasi = Estimasi::where('order_id', $id)->where('barang_id', $bi)->get();
                    
                    if($estimasi->isEmpty() == true)
                    {
                    
                            $order->estimasi()->create([
                                'barang_id'=>$barang_id[$i],
                                'jumlah'=>$jumlah[$i],
                                'harga' => $harga,
                                'total_harga' => $totalharga,
                                'satuan' => $request->satuan[$i],
                                'user_id'=> $user
                                ]);
                                   

                        return redirect()->back()->with('flash_message','Bahan Sudah di Tambahkan Ke dalam Order');
                    }else{
                        return redirect()->back()->with('flash_message_danger','Bahan Sudah Ada');
                    }
                }
            }
            
        }
    }


    public function hapusEstimasiBarang($idOrder,$idBarang)
    {
        $estimasi = Estimasi::where('order_id',$idOrder)->where('barang_id',$idBarang)->first();
        $estimasi->delete();  
        return redirect()->back()->with('flash_message', 'Bahan Di delete!');
        
    }

    public function reportPdf($estimasi)
    {
        $barang = Barang::pluck('nama_barang', 'id');
        $order = Order::with('estimasi')->find($estimasi);
        $totalharga = Estimasi::where('order_id',$estimasi);

        $pdf = PDF::loadView('admin.estimasi.reportpdf',compact('order','barang', 'totalharga'));
        return $pdf->setPaper('a4', 'landscape')->setWarnings(false)->stream();
       
    }

}

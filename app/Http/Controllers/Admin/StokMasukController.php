<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StokMasuk;
use App\Barang;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\StokMasukDataTable;
use Yajra\Datatables\Datatables;

class StokMasukController extends Controller
{

    public function index(StokMasukDataTable $dataTable)
    {
        return $dataTable->render('admin.stok-masuk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $barang = Barang::pluck('nama_barang','id')->toArray();
        $order = Order::where('status',0)->pluck('no_order','id')->toArray();
        return view('admin.stok-masuk.create', compact('barang','order'));
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
        //dd($request->all());
        $this->validate($request, [
			
			'barang_id' => 'required',
			'tgl_beli' => 'required',
            'jumlah' => 'required',
            'order_id' => 'required',
            'harga' => 'required'
        ]);
        $harga = intval(preg_replace('/[^0-9]/', '', $request['harga']));
        $requestData = [
            'barang_id' => $request['barang_id'],
			'tgl_beli' => $request['tgl_beli'],
            'jumlah' => $request['jumlah'],
            'order_id' => $request['order_id'],
            'harga' => $harga
        ];
        
        
        
        if(0 == $request['barang_id'])
        {
            return redirect()->back()->with('flash_message', 'silahkan isi nama barang');
        }
        // pembelian stok barang
        $sm = StokMasuk::create($requestData);
        $sm->user()->associate(Auth::id());
        $sm->save();

        // penambahan stok barang
        $b = Barang::find($request['barang_id']);
        $h = ($b->jumlah) + $request['jumlah'];
        $b->jumlah = $h;
        $b->save();

        if($request['order_id'] === null || $request['order_id'] === "0")
        {
            return redirect('admin/stok-masuk')->with('flash_message', 'StokMasuk added Null!');
        }
        //pengurangan modal
        $order = Order::find($request['order_id']);
        $kurang = ($order->sisa) - $harga; 
        $order->sisa = $kurang;
        $order->save();
        return redirect('admin/stok-masuk')->with('flash_message', 'StokMasuk added!');
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
        $stokmasuk = StokMasuk::findOrFail($id);

        return view('admin.stok-masuk.show', compact('stokmasuk'));
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
        $stokmasuk = StokMasuk::findOrFail($id);

        return view('admin.stok-masuk.edit', compact('stokmasuk'));
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
			
			'barang_id' => 'required',
			'tgl_beli' => 'required',
			'jumlah' => 'required'
		]);
        $requestData = $request->all();
        
        $stokmasuk = StokMasuk::findOrFail($id);
        $stokmasuk->update($requestData);

        return redirect('admin/stok-masuk')->with('flash_message', 'StokMasuk updated!');
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
        $stokmasuk = StokMasuk::find($id);
        $smid = $stokmasuk->order_id;
        $bid = $stokmasuk->barang_id;
        $harga = $stokmasuk->harga;
        $jumlah = $stokmasuk->jumlah;

        
        $order = Order::find($smid);
        $sisa = ($order->sisa) + $harga;
        $order->sisa = $sisa;
        $order->save();

        $barang = Barang::find($bid);
        $tambah = ($barang->jumlah) - $jumlah;
        $barang->jumlah = $tambah;
        $barang->save();

        StokMasuk::destroy($id);

        //return redirect('admin/stok-masuk')->with('flash_message', 'StokMasuk deleted!');
    }
}

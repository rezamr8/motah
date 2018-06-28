<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StokKeluar;
use App\Barang;
use Illuminate\Http\Request;

class StokKeluarController extends Controller
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
            $stokkeluar = StokKeluar::where('barang_id', 'LIKE', "%$keyword%")
                ->orWhere('jumlah', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $stokkeluar = StokKeluar::paginate($perPage);
        }

        return view('admin.stok-keluar.index', compact('stokkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $barang = Barang::pluck('nama_barang', 'id');
        return view('admin.stok-keluar.create',compact('barang'));
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
			'jumlah' => 'required'
		]);
        $requestData = $request->all();
        
        StokKeluar::create($requestData);

        return redirect('admin/stok-keluar')->with('flash_message', 'StokKeluar added!');
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
        $stokkeluar = StokKeluar::findOrFail($id);

        return view('admin.stok-keluar.show', compact('stokkeluar'));
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
        $barang = Barang::pluck('nama_barang', 'id');
        $stokkeluar = StokKeluar::findOrFail($id);

        return view('admin.stok-keluar.edit', compact('stokkeluar'))->with('barang',$barang);
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
			'jumlah' => 'required'
		]);
        $requestData = $request->all();
        
        $stokkeluar = StokKeluar::findOrFail($id);
        $stokkeluar->update($requestData);

        return redirect('admin/stok-keluar')->with('flash_message', 'StokKeluar updated!');
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
        StokKeluar::destroy($id);

        return redirect('admin/stok-keluar')->with('flash_message', 'StokKeluar deleted!');
    }
}

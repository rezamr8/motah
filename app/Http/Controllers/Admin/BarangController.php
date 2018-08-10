<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
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
            $barang = Barang::where('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('jumlah', 'LIKE', "%$keyword%")
                ->orWhere('satuan', 'LIKE', "%$keyword%")
                ->orWhere('harga', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $barang = Barang::paginate($perPage);
        }

        return view('admin.barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.barang.create');
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
            'nama_barang' => 'required',
            'jumlah' => 'required',
			'satuan' => 'required'
		]);
        $requestData = [
            'nama_barang' => $request['nama_barang'],
            'satuan'=> $request['satuan'],
            'jumlah'=> $request['jumlah'],
            'harga' => $request['harga']
        ];
        
        Barang::create($requestData);

        return redirect('admin/barang')->with('flash_message', 'Barang added!');
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
        $barang = Barang::findOrFail($id);

        return view('admin.barang.show', compact('barang'));
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
        $barang = Barang::findOrFail($id);

        return view('admin.barang.edit', compact('barang'));
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
			'nama_barang' => 'required',
            'jumlah' => 'required',
            'harga' => 'required'
		]);
        $requestData = $request->all();
        
        $barang = Barang::findOrFail($id);
        $barang->update($requestData);

        return redirect('admin/barang')->with('flash_message', 'Barang updated!');
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
        Barang::destroy($id);

        return redirect('admin/barang')->with('flash_message', 'Barang deleted!');
    }
}

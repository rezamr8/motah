<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\JenisOrder;
use Illuminate\Http\Request;

class JenisOrderController extends Controller
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
            $jenisorder = JenisOrder::where('nama_order', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $jenisorder = JenisOrder::paginate($perPage);
        }

        return view('admin.jenis-order.index', compact('jenisorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.jenis-order.create');
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
            'nama_order' => 'required',
            'jenis' => 'required'
		]);
        $requestData = $request->all();
        
        JenisOrder::create($requestData);

        return redirect('admin/jenis-order')->with('flash_message', 'JenisOrder added!');
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
        $jenisorder = JenisOrder::findOrFail($id);

        return view('admin.jenis-order.show', compact('jenisorder'));
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
        $jenisorder = JenisOrder::findOrFail($id);

        return view('admin.jenis-order.edit', compact('jenisorder'));
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
            'nama_order' => 'required',
            'jenis' => 'required'
		]);
        $requestData = $request->all();
        
        $jenisorder = JenisOrder::findOrFail($id);
        $jenisorder->update($requestData);

        return redirect('admin/jenis-order')->with('flash_message', 'JenisOrder updated!');
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
        JenisOrder::destroy($id);

        return redirect('admin/jenis-order')->with('flash_message', 'JenisOrder deleted!');
    }
}

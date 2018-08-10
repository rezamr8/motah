<?php

namespace App\DataTables;

use App\StokMasuk;
use Yajra\DataTables\Services\DataTable;

class StokMasukDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('order.no_order', function ($n) {
                if ($n->order_id == 0) return "<p style='color: #FFFFFF;background-color:#0000ff;text-align: center;'>TANPA ORDER</p>";
                return $n->order->no_order;
            })
            ->editColumn('jumlah', function($n){
                return $n->jumlah;
            })
            ->editColumn('action', function ($n) {
                if (empty($n->order->status)) return view('admin.actions.stokmasuk',compact('n'));
                return 'Order Beres';
            })
            ->rawColumns(['order.no_order','action']);
            //->addColumn('action', 'admin.actions.stokmasuk');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = StokMasuk::with(['order', 'barang']);
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            //bisa pake cara di comment
            //'order.no_order' => ['name' => 'order','data' => 'order.no_order'],
            'id' =>['name' =>'id', 'visible' => false],
            'No Order' => ['data' => 'order.no_order'],
            'Nama Barang' => ['data' => 'barang.nama_barang'],
            'Jumlah' => ['name' => 'jumlah', 'data' => 'jumlah'],
            'Harga' => ['data' => 'harga',"render" => " $.fn.dataTable.render.number(',', '.', 0, 'Rp ').display(data)"]
            
        ];
    }

    protected function noorder()
    {
        
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StokMasuk_' . date('YmdHis');
    }
}

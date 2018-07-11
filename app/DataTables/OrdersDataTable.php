<?php

namespace App\DataTables;

use App\Order;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
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
            ->addColumn('action', 'layouts.action');
    }

    
    public function query()
    {
        $query = Order::with('jenisorder')->where('status',0)->select();
        return $this->applyScopes($query);
    }

   
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
            "no_order",
            "tgl_beres",
            "modal" => ["render" => " $.fn.dataTable.render.number(',', '.', 0, 'Rp ').display(data)"],
            "sisa" => ["render" => " $.fn.dataTable.render.number(',', '.', 0, 'Rp ').display(data)"]
            
        ];

        
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}

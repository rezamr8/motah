<?php
namespace App\Exports;
use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderReport implements FromCollection
{
    public function collection()
    {
        return Order::all();
    }
}
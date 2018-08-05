<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Pembelian</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .table-borderless td,
        .table-borderless th {
            border: 0;
        }
        ul ul, ol ul {
            list-style-type: none;
            padding-left: 20px;
        }
        
    </style>
</head>
<body>
    <h1><i class="fa fa-dropbox fa-lg text-danger" aria-hidden="true"></i>Order Pembelian Barang</h1>
    <h2>NO :{{ $order->no_order }}</h2>
    <h3>JENIS : {{$order->jenisorder->jenis}}</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->estimasi as $o)
            <tr>
                <td>{{ $loop->iteration or $item->id }}</td>
                <td>{{$o->barang()->withTrashed()->get()->first()->nama_barang}}</td>
                <td>{{$o->jumlah}}</td>
                <td>Rp {{ number_format($o->harga) }}</td>
                <td class="totharga">Rp {{ number_format($o->total_harga) }}</td>
                <td>{{$o->barang()->withTrashed()->get()->first()->satuan}}</td>
                
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    Total Modal
                </td>
                <td class="sumharga">
                   Rp {{number_format($totalharga->sum('total_harga'))}}
                </td>
                <td></td>
               
            </tr>
        </tbody>
    </table>
    

    <script src="{{ asset('js/app.js') }}"></script>

  
</body>
</html>

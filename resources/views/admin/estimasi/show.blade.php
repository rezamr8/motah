@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Order {{ $order->no_order }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/estimasi') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    
                                    <tr><th> Jenis Order </th><td> {{ $order->no_order }} </td></tr><tr><th> Jumlah </th><td> {{ $order->jumlah }} </td></tr><tr><th> Tgl Beres </th><td> {{ $order->tgl_beres }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        </br>
                       <div class="card">
                            <div class="card-header"><h4 class="text-center">Order Pembelian <a href="{{ url('admin/report/'.$order->id)}}"><i class="fa fa-print"></i></a></h4></div>
                            <div class="card-body">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Satuan</th>
                                            <th>Action</th>
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
                                            <td>
                                            {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['admin/order',$o->order_id, 'estimasi', $o->barang_id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Barang',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">
                                                Total Modal
                                            </td>
                                            <td class="sumharga">
                                              
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                       </div>
                        </br>
                        {!! Form::open(['route' => ['order.estimasi', $order->id], 'class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="card">
                        <div class="form-group table-fields">
                                <div class="card-header"><h4 class="text-center">Add Barang</h4> </div>
                                <div class="card-body">
                                

                                <div class="entry   form-inline">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                   
                                                    {!!
                                                        Form::select(
                                                            'barang_id[]', 
                                                            $barang, 
                                                            null, 
                                                            ['class' => 'form-control ajaxHarga', 'placeholder' => 'Please Select', 'value' => 0])
                                                        !!}
                                                    
                                                </td>
                                                
                                                <td>{!! Form::text('jumlah[]', null, ('required' == 'required') ? ['class' => 'jumlah form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}</td>
                                                <td>{!! Form::text('harga[]', null, ('required' == 'required') ? ['class' => 'harga form-control', 'required' => 'required', 'readonly' => 'true'] : ['class' => 'form-control']) !!}</td>
                                                <td>{!! Form::text('totalharga[]', null, ('required' == 'required') ? ['class' => 'totalharga form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}</td>
                                               
                                            </tr>
                                        </tbody>
                                    </table>
             
                                </div>
                                </div>
                        </div>
                                                            
                        <button class="btn btn-primary" type="submit">SAVE</button>
                        {!! Form::close() !!}
                                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.ajaxHarga').select2();
            var totharga = 0;
            $('.jumlah').keyup(function(){
                var jumlah = $('.jumlah').val();
                var harga = $('.harga').val();
                var hasil ;
                hasil = jumlah * parseInt(harga.replace(/,|[^0-9]/g, ''), 10);;
                $('.totalharga').val(hasil);
                currency();
            });

            $('.table tbody .totharga').each(function() {
                totharga += parseInt($(this).text().replace(/[^0-9]/g, ''));
            });
            $('.sumharga').html(convertToRupiah(totharga));
            
            function convertToRupiah(angka)
            {
                var rupiah = '';		
                var angkarev = angka.toString().split('').reverse().join('');
                for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                return 'Rp '+rupiah.split('',rupiah.length-1).reverse().join('');
            }
           
           // func currency
           function currency(){
            anElement = new AutoNumeric.multiple(['.harga', '.totalharga'],{
                        caretPositionOnFocus: "start",
                        currencySymbol: "Rp ",
                        decimalCharacterAlternative: ",",
                        decimalPlaces: 0
                    });
           }
           //funcajaxharga
           $('.ajaxHarga').change(function(){
               console.log('harga');
               $.get('{{ route("get.harga") }}', {id:$('.ajaxHarga').val()},function(data,status){
                $('.harga').val(data.harga);
                    currency();
                    $('.totalharga').val('');
                    $('.jumlah').val('');
               });
           });

        });
    </script>
@endsection
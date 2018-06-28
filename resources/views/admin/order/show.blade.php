@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Order {{ $order->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/order') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/order/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/order', $order->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Order',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $order->id }}</td>
                                    </tr>
                                    <tr><th> Jenis Order </th><td> {{ $order->no_order }} </td></tr><tr><th> Jumlah </th><td> {{ $order->jumlah }} </td></tr><tr><th> Tgl Beres </th><td> {{ $order->tgl_beres }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        </br>
                        <!-- Detail Order -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>BARANG</th>
                                        <th>JUMLAH</th>
                                    </tr>
                                    @foreach($order->transaksi as $o)
                                    <tr>
                                        <td>{{$o->barang->nama_barang}}</td>
                                        <td>{{$o->jumlah}}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        <!-- End Detail Order -->

                        {!! Form::open(['route' => ['order.transaksi', $order->id], 'class' => 'form-horizontal', 'files' => true]) !!}

                        
                        <div class="form-group table-fields">
                                <h4 class="text-center">Add Barang</h4><br>
                                <div class="entry col-md-10  form-inline">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>{!! Form::label('barang', 'BARANG') !!}</th>
                                                <td>
                                                    <!-- {!! Form::select('barang_id', $barang, null, ['class' => 'form-control']) !!} -->
                                                    {!!
                                                        Form::select(
                                                            'barang_id[]', 
                                                            $barang, 
                                                            null, 
                                                            ['class' => 'form-control', 'placeholder' => 'Please Select', 'value' => 0])
                                                        !!}
                                                    
                                                </td>
                                                <th>{!! Form::label('jumlah', 'JUMLAH') !!}</th>
                                                <td>{!! Form::text('jumlah[]', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}</td>
                                                <td> 
                                                    <button class="btn btn-success btn-add inline btn-sm" type="button">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
             
                                </div>
                        </div>

                        <button class="btn btn-primary" type="submit">SAVE</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var tableFields = $('.table-fields'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(tableFields);

                newEntry.find('input').val('');
                tableFields.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });

        });
    </script>
@endsection
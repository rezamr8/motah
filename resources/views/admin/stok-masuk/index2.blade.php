@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Stok Masuk</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/stok-masuk/create') }}" class="btn btn-success btn-sm" title="Add New Stok Masuk">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/stok-masuk', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>No Order</th><th>Barang</th><th>Tgl Beli</th><th>Jumlah</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($stokmasuk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        @if(empty($item->order->no_order))
                                        <td>BELI TANPA ORDER</td>
                                        @else
                                        <td>{{ $item->order->no_order }}</td>
                                        @endif
                                        
                                        <td>{{ $item->barang->nama_barang }}</td><td>{{ $item->tgl_beli }}</td><td>{{ $item->jumlah }}</td>
                                        <td>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/stok-masuk', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Stok Masuk',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $stokmasuk->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

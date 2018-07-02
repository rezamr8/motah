@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Order</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/order/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <!-- {!! Form::open(['method' => 'GET', 'url' => '/admin/order', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!} -->

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless" id="order-table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Jenis Order</th><th>NO ORDER</th><th>JUMLAH</th><th>Tgl SELESAI</th><th>MODAL</th><th>SISA</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                @foreach($order as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ strtoupper($item->jenisorder->nama_order) }}</td><td>{{ strtoupper($item->no_order) }}</td><td>{{ $item->jumlah }}</td><td>{{ $item->tgl_beres }}</td>
                                        <td>
                                            <a href="{{ url('/admin/order/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/order/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/order', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Order',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody> -->
                            </table>
                            <div class="pagination-wrapper"> {!! $order->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function() {
    var template = Handlebars.compile($("#details-template").html());
    var table = $('#order-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'order/data',
        columns: [
        	{
                "className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            // { data: 'jenisorder.nama_order', name:'jenisorder.nama_order'},
            { data: 'no_order', name: 'no_order'},
            { data: 'jumlah', name: 'jumlah'},
            { data: 'tgl_beres', name: 'tgl_beres'},
            { data: 'modal', name: 'modal'},
            { data: 'sisa', name: 'sisa'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
            
            
        ],
        order: [[1, 'desc']],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement('input');
                $(input).appendTo($(column.footer()).empty())
                .on("change", function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
    });

    table.column( 1 ).visible( false );

    // Add event listener for opening and closing details
    $('#order-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'orders-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'barang.nama_barang', name:'barang_id'},
                { data: 'jumlah', name: 'jumlah'}
                
            ]
        })
    }

    
});
    </script>
    <script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">Order OrderDetail</div>
        <table class="table details-table" id="orders-@{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>BARANG</th>
                <th>JUMLAH</th>
                
            </tr>
            </thead>
        </table>
    </script>
@endsection

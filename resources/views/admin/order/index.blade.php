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

                       

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless" id="order-table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Jenis Order</th><th>NO ORDER</th><th>JUMLAH</th><th>Tgl SELESAI</th><th>MODAL</th><th>SISA</th><th>Actions</th>
                                    </tr>
                                </thead>
                                
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
        ajax: '{{route("order.data")}}',
        columns: [
        	{
                "className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
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
               
                { data: 'barang.nama_barang', name:'barang_id'},
                { data: 'jumlah', name: 'jumlah'},
                { data: 'harga', name: 'harga'}
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
                
                <th>BARANG</th>
                <th>JUMLAH</th>
                <th>HARGA</th>
                
            </tr>
            </thead>
        </table>
    </script>
@endsection

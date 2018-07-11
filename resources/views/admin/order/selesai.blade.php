@extends('layouts.backend')

@section('content')
<div class="container">
        <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="card">
            <div class="card-header">ORDER SELESAI</div>
              <div class="card-body">
                {!! $dataTable->table() !!}
              </div>
            </div>
        </div>
        </div>

        

<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ORDER DETAIL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        <!-- end modal -->

</div>

@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

<script>
     $("#detail").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('target-id');
        $.get('/admin/order/detail/' + id, function( data ) {
           $(".modal-body").html(data);
           anElement = new AutoNumeric.multiple(['#modal', '#sisa', '#harga'],{
           caretPositionOnFocus: "start",
           currencySymbol: "Rp ",
           decimalPlaces: 0
           });
        });
        
      });

      
</script>

@endsection
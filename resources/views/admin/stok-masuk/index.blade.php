@extends('layouts.backend')

@section('content')
<div class="container">
        <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="card">
            <div class="card-header">ON PROGRESS ORDER</div>
              <div class="card-body">
                {!! $dataTable->table() !!}
              </div>
            </div>
        </div>
        </div>
@endsection

@section('scripts')
<link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

<script>
$(document).ready(function() {

  $(document).on('click', '#delstok', function(e){
			
      var id = $(this).data('id');
      console.log(id);
			SwalDelete(id);
			e.preventDefault();
		});
		
	
	
	function SwalDelete(id){
		swal({
			title: 'Data Akan di Hapus?',
			text: "Data Stok Barang Akan di Hapus!",
			icon: 'warning',
			buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            type: 'DELETE',
            url: '\stok-masuk/'+id,
            //url: '{{ route("stok-masuk.destroy", ["stok_masuk" => '+id+']) }}',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { 'id': id, 'method_field': 'DELETE', "_token": "{{ csrf_token() }}"},
            success: function(response) {
              swal("Data Stok Masuk Sukses Di delete", {
                icon: "success",
              }).then((value)=>{
                window.location.href = "stok-masuk"; // http://motah.test/admin/stok-masuk
              });
                
              } 
          })
          
        } else {
          swal("Data Stok Masuk Tidak Jadi di Delete");
        }

    })

	}

});

</script>

@endsection
@extends('layouts.backend')
@section('content')
<div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
            
            <div class="card mb-2">
                <div class="card-header">Report Keluar</div>
                <div class="card-body">
                
                {!! Form::open(['method' => 'get', 'url' => '/admin/report/export/xls', 'role' => 'search'])  !!}
                    <div class="form-group">
                      <label for="tgl_awal">Tanggal</label>
                      <input type="text" name="tgl_awal" id="tgl_awal" class="form-control" placeholder="Masukan Tanggal" aria-describedby="tgl_awalID">
                      <small id="tgl_awalID" class="text-muted">Masukan Awal Tanggal</small>
                    </div>
                    <div class="form-group">
                      <label for="tgl_akhir">Tanggal Akhir</label>
                      <input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control" placeholder="Masukan Tanggal" aria-describedby="tgl_akhirID">
                      <small id="tgl_akhirID" class="text-muted">Masukan Akhir Tanggal</small>
                    </div>

                    <button class="btn btn-success" type="submit">
                                    <i class="fa fa-file-excel-o"></i>
                                </button>

                    <input type="button" value="FILTER" name="filter" id="filter" class="btn  btn-primary">
                {!! Form::close() !!}
                
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Report Filter
                </div>
                <div class="card-body">
                    <div id="orderFilter">
                    </div>
                </div>
            </div>
            
            </div>
        </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(function (){
        $('#tgl_awal, #tgl_akhir').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true
        });

        $('#filter').click(function(){
        
            var from_date = $('#tgl_awal').val();
            var to_date = $('#tgl_akhir').val();

            if( from_date != '' && to_date != ''){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                url:"{{ route('report.tanggal') }}",
                method:"POST",
                data:{tgl_awal:from_date,tgl_akhir:to_date},
                success:function(data)
                {
                console.log(data);
                $('#orderFilter').empty().html(data);
                
                }
            });

            

            }else{
            swal('Upss','isi dahulu tanggal nya','error');
            }
        })
        
    });
        
</script>
@endsection
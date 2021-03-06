@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Stok Masuk</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/stok-masuk') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/stok-masuk', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.stok-masuk.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(function (){
        $('#tgl_beli').datepicker({
            format: 'yyyy/mm/dd',
            todayHighlight: true
        });
        anElement = new AutoNumeric('#harga',{
           
           caretPositionOnFocus: "start",
           currencySymbol: "Rp ",
           decimalPlaces: 0
           });
        $('#barang_id').select2();
        $('#order_id').select2();
    });
        
</script>
@endsection

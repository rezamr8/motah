@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-header">Total ORDER </div>

                    <div class="card-body">
                    <h1 class="text-center">{{ $orders_count }}</h1>
                    </div>
                </div>

                </br>
                <div class="card text-white bg-primary">
                    <div class="card-header">TOTAL MODAL Bulan {{  strtoupper(date('F')) }}</div>

                    <div class="card-body">
                    <h2 class="text-center" id="totalmodal">Rp {{ number_format($total_modal) }}</h2>
                    </div>
                </div>
            
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-header">ORDER SELESAI </div>

                    <div class="card-body">
                       <h1 class="text-center">{{ $order_selesai }}</h1>
                    </div>
                </div>
                </br>
                <div class="card text-white bg-success">
                    <div class="card-header">SISA MODAL Bulan {{  strtoupper(date('F')) }}</div>

                    <div class="card-body">
                       <h2 class="text-center" id="sisamodal">Rp {{ number_format($sisa_modal) }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card ext-white bg-warning">
                    <div class="card-header">ORDER ON PROGRESS </div>

                    <div class="card-body">
                       <h1 class="text-center">{{$order_progress}}</h1>
                    </div>
                </div>
            </div>

 
        </div>
    </div>
@endsection

@section('scripts')
<script>
 anElement = new AutoNumeric.multiple(['#totalmodal','#sisamodal'],{
           
           caretPositionOnFocus: "start",
           currencySymbol: "Rp ",
           decimalPlaces: 0
           });
</script>
@endsection

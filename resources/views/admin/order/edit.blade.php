@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Order #{{ $order->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/order') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($order, [
                            'method' => 'PATCH',
                            'url' => ['/admin/order', $order->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                       
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $order->id }}</td>
                                    </tr>
                                    <tr><th> Jenis Order </th><td> {{ $order->no_order }} </td></tr><tr><th> Jumlah </th>
                                    <td> 
                                   
        {!! Form::number('jumlah', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
     </td>
</tr>
<tr><th>{!! Form::label('modal', 'Modal', ['class' => 'control-label']) !!}</th><td>

 {!! Form::text('modal', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
 {!! $errors->first('modal', '<p class="help-block">:message</p>') !!}

</td></tr>
<tr><th> Tgl Beres </th><td> {{ $order->tgl_beres }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
anElement = new AutoNumeric.multiple(['#modal'],{
                        caretPositionOnFocus: "start",
                        currencySymbol: "Rp ",
                        decimalCharacterAlternative: ",",
                        decimalPlaces: 0
                    });
</script>
@endsection

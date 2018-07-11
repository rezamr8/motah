
<div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
    {!! Form::label('order_id', 'No Order', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('order_id', ['0'=>''] + $order, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('barang_id') ? 'has-error' : ''}}">
    {!! Form::label('barang_id', 'NAMA BARANG', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('barang_id', ['0'=>''] + $barang, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('barang_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tgl_beli') ? 'has-error' : ''}}">
    {!! Form::label('tgl_beli', 'Tgl Beli', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tgl_beli', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('tgl_beli', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('jumlah') ? 'has-error' : ''}}">
    {!! Form::label('jumlah', 'Jumlah', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('jumlah', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('harga') ? 'has-error' : ''}}">
    {!! Form::label('harga', 'Harga', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('harga', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nama_barang') ? 'has-error' : ''}}">
    {!! Form::label('nama_barang', 'Nama Barang', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nama_barang', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('nama_barang', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('stok_awal') ? 'has-error' : ''}}">
    {!! Form::label('stok_awal', 'Stok Awal', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('stok_awal', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('stok_awal', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('satuan') ? 'has-error' : ''}}">
    {!! Form::label('satuan', 'Satuan', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('satuan', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

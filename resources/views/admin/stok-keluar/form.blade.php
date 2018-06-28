<div class="form-group {{ $errors->has('barang_id') ? 'has-error' : ''}}">
    {!! Form::label('barang_id', 'Id Barang', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <!-- {!! Form::number('barang_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!} -->
        {!! Form::select('barang_id', $barang, null, ['class' => 'form-control']) !!}
        {!! $errors->first('barang_id', '<p class="help-block">:message</p>') !!}
       
        
    </div>

    
</div><div class="form-group {{ $errors->has('jumlah') ? 'has-error' : ''}}">
    {!! Form::label('jumlah', 'Jumlah', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('jumlah', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
    </div>
    
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

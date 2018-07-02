<div class="form-group {{ $errors->has('jenis_order') ? 'has-error' : ''}}">
    {!! Form::label('jenis_order', 'Jenis Order', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <!-- {!! Form::text('jenis_order', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!} -->
        {!! Form::select('jenis_order_id', $jo, null, ['class' => 'form-control']) !!}
        
        {!! $errors->first('jenis_order', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('jumlah') ? 'has-error' : ''}}">
    {!! Form::label('jumlah', 'Jumlah', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('jumlah', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tgl_beres') ? 'has-error' : ''}}">
    {!! Form::label('tgl_beres', 'Tgl Beres', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tgl_beres', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('tgl_beres', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('modal') ? 'has-error' : ''}}">
    {!! Form::label('modal', 'Modal', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('modal', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('modal', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@extends('layouts.backend')

@section('content')
<div class="container">
        <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            {!! $dataTable->table() !!}
        </div>
        </div>
</div>

@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endsection
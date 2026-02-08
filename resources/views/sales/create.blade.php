@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('sales.store') }}" accept-charset="UTF-8" id="form" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
	@csrf
	<div class="card">
		<div class="card-header">Invoice</div>
		<div class="card-body">
			@include('sales._form')
		</div>
		<div class="card-footer d-flex justify-content-end">
			<button type="submit" class="btn btn-sm btn-outline-primary me-1 my-auto"><i class="fa-regular fa-floppy-disk"></i> Submit</button>
			<a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-secondary me-1 my-auto">Cancel</a>
		</div>
	</div>

</form>
@endsection

@section('js')
@include('sales._js')
@endsection

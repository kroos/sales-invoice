@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('products.update', $product) }}" accept-charset="UTF-8" id="form" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	<div class="card mb-2">
		<div class="card-header">Edit Product</div>
		<div class="card-body">
			@include('products._form')
		</div>
		<div class="card-footer d-flex justify-content-end">
			<button type="submit" class="btn btn-sm btn-outline-primary me-1"><i class="fa-regular fa-floppy-disk"></i> Submit</button>
			<a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary me-1">Cancel</a>
		</div>
	</div>
</form>



<div class="card">
	<div class="card-header">Product Image List</div>
	<div class="card-body">
		<div class="col-sm-12 table-responsive">
			<table id="at" class="table table-border table-hover "></table>
			</div>
		</div>
</div>
@endsection

@section('js')
@include('products._js')
@endsection

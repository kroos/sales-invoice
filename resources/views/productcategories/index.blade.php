@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h3>Product Category List</h3>
		<a href="{{ route('productcategories.create') }}" class="my-auto btn btn-sm btn-outline-primary">New Product Category </a>
	</div>
	<div class="card-body table-responsive">
		<table id="at" class="table table-border table-hover "></table>
	</div>
</div>
@endsection


@section('js')
window.data = {
	routes: {
		getProducts: '{{ route('getProducts') }}',
	},
	urls: {
		productcategories: `{{ url('productcategories') }}`,
	},
	olds: {
	},
};
@endsection

@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between">
		<he class="my-auto">Product List</he>
		<a href="{!! route('products.create') !!}" class="btn btn-sm btn-outline-info my-auto">New Product</a>
	</div>
	<div class="card-body table-responsive">

		<table id="at" class="table table-border table-hover "></table>

	</div>
	<div class="card-footer d-flex justify-content-end">
	</div>
</div>
@endsection

@section('js')
window.data = {
	routes: {
		getProductsdT: '{{ route('getProductsdT') }}',
	},
	urls: {
		products: `{{ url('products') }}`,
		productsdestroy: '{{ url('products.destroy') }}',
	}
};
@endsection

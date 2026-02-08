@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h3 class="my-auto">Invoice List</h3>
		<a href="{!! route('sales.create') !!}" class="btn btn-sm btn-outline-info my-auto">New Invoice</a>
	</div>
	<div class="card-body">
		<div class="col-lg-12 table-responsive" id="load-products">
			<table id="at" class="table table-hover"></table>
		</div>
	</div>
</div>
@endsection

@section('js')
window.data = {
		routes: {
			geSales: '{{ route('geSales') }}',
			sales: '{{ url('sales')}}',
			printpdf: '{{ url('printpdf')}}',
			emailpdf: '{{ url('emailpdf')}}',
		},
};
@endsection

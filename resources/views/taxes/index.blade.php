@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h3 class="my-auto">Tax List</h3>
		<a href="{!! route('taxes.create') !!}" class="my-auto btn btn-sm btn-outline-info">New Tax</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="at" class="table table-hover"></table>
		</div>
	</div>
</div>
@endsection

@section('js')
window.data = {
	routes: {
		getTaxes: '{{ route('getTaxes') }}',
	},
	urls: {
		taxes: `{{ url('taxes') }}`,
	},
	olds: {

	},
};
@endsection

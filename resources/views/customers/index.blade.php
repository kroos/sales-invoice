@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">Customers List</div>
		<div class="card-body">
			<div class="table-responsive">

				<table id="at" class="table table-hover"></table>

			</div>
		</div>
	</div>
@endsection

@section('js')
window.data = {
	route: {
		getCustomers: '{{ route('getCustomers') }}',
	},
	url: {
		customers: '{{ url('customers') }}',
	},
	old: {
	},
};
@endsection

@extends('layouts.app')

@section('content')
	<div class="card card-default">
		<div class="card-header d-flex justify-content-between">
			<span>Banks and Financial Institutions</span>
			<a href="{!! route('banks.create') !!}" class="btn btn-sm btn-info">New Bank</a>
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
	route: {
		getBanksT: '{{ route('getBanksT') }}',
	},
	url: {
		banks: '{{ url('banks') }}',
	},
	old: {},
};

@endsection

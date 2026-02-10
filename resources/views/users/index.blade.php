@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h3 class="my-auto">User list</h3>
		<a href="{{ route('users.create') }}" class="my-auto btn btn-sm btn-outline-primary">New User </a>
	</div>
	<div class="card-body">
		<table id="at" class="table"></table>
	</div>
	<div class="card-footer">
	</div>
</div>
@endsection


@section('js')
window.data = {
	route: {
		getUser: '{{ route('getUser') }}',
	},
	url: {
		users: '{{ url('users') }}',
		user: '{{ url('user') }}',
	},
	old: {},
};
@endsection

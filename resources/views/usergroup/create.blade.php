@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('usergroups.store') }}" accept-charset="UTF-8" id="form" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
	@csrf
	<div class="card mb-3">
		<div class="card-head">Add User Group</div>
		<div class="card-body">

			<div class="form-group row m-1 @error('group') has-error @enderror">
				<label for="ug" class="col-form-label col-sm-4">User Group : </label>
				<div class="col-sm-6 my-auto">
					<input type="text" name="group" value="{{ old('group') }}" id="ug" class="form-control form-control-sm @error('group') is-invalid @enderror" placeholder="User Group">
					@error('group')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

			</div>
		</div>
		<div class="card-footer d-flex justify-content-end">
			<button type="submit" class="btn btn-sm btn-outline-primary me-1">
				<i class="fa-regular fa-floppy-disk"></i> Submit</button>
			<a href="{{ route('usergroups.create') }}" class="btn btn-sm btn-outline-secondary me-1">Cancel</a>
		</div>
	</div>
</form>

<div class="card">
	<div class="card-header">User Groups List</div>
	<div class="card-body">
		<div class="table-responsive">

			<table id="at" class="table table-border table-hover "></table>

		</div>
	</div>
</div>

@endsection


@section('js')
window.data = {
	routes: {
		getUser: '{{ route('getUser') }}',
	},
	urls: {
		usergroups: '{{ url('usergroups') }}',
	},
	olds: {
	},
};

@endsection

@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">Print Report</div>
	<div class="card-body">
		<div class="col-sm-12 row">

			<form method="POST" action="{{ route('printreport.store') }}" accept-charset="UTF-8" id="salesform" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
				@csrf
				<div class="card">
					<div class="card-header">Sales Report</div>
					<div class="card-body">

						<div class="form-group row m-1 @error('from') has-error @enderror">
							<label for="from1" class="col-form-label col-sm-2">From : </label>
							<div class="col-sm-6 my-auto">
								<input type="text" name="from" value="{{ old('from', @$variable->from) }}" id="from1" class="form-control form-control-sm @error('from') is-invalid @enderror" placeholder="From">
								@error('from')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="form-group row m-1 @error('to') has-error @enderror">
							<label for="to1" class="col-form-label col-sm-2">To : </label>
							<div class="col-sm-6 my-auto">
								<input type="text" name="to" value="{{ old('to', @$variable->to) }}" id="to1" class="form-control form-control-sm @error('to') is-invalid @enderror" placeholder="To">
								@error('to')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="form-group row m-1 @error('user.*') has-error @enderror">
							<label for="seller" class="col-form-label col-sm-2">Merchandiser : </label>
							<div class="col-sm-6 my-auto">
								<select name="user[]" id="seller" class="form-select form-select-sm col-sm-12 @error('user.*') is-invalid @enderror" multiple></select>
								@error('user.*')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="card-footer d-flex justify-content-end">
						<button type="submit" class="btn btn-sm btn-outline-primary me-1">
							<i class="fa-regular fa-floppy-disk"></i> Submit
						</button>
						<a href="{{-- route('banks.index') --}}" class="btn btn-sm btn-outline-secondary me-1">Cancel</a>
					</div>
				</div>
			</form>




			<form method="POST" action="{{ route('printreport.audit') }}" accept-charset="UTF-8" id="auditsales" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
				@csrf
				<div class="card">
					<div class="card-header">Audit</div>

					<div class="card-body">

						<div class="form-group row m-1 @error('from1') has-error @enderror">
							<label for="from2" class="col-form-label col-sm-2">From : </label>
							<div class="col-sm-6 my-auto">
								<input type="text" name="from1" value="{{ old('from1', @$variable->from1) }}" id="from2" class="form-control form-control-sm @error('from1') is-invalid @enderror" placeholder="From">
								@error('from1')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="form-group row m-1 @error('to1') has-error @enderror">
							<label for="to2" class="col-form-label col-sm-2">To : </label>
							<div class="col-sm-6 my-auto">
								<input type="text" name="to1" value="{{ old('to1', @$variable->to1) }}" id="to2" class="form-control form-control-sm @error('to1') is-invalid @enderror" placeholder="To">
								@error('to1')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="form-group row m-1 @error('user1.*') has-error @enderror">
							<label for="seller1" class="col-form-label col-sm-2">Merchandiser : </label>
							<div class="col-sm-6 my-auto">
								<select name="user1[]" id="seller1" class="form-select form-select-sm col-sm-12 @error('user1[]') is-invalid @enderror" multiple></select>
								@error('user1.*')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="card-footer d-flex justify-content-end">
						<button type="submit" class="btn btn-sm btn-outline-primary me-1"><i class="fa-regular fa-floppy-disk"></i> Submit</button>
						<a href="{{-- route('banks.index') --}}" class="btn btn-sm btn-outline-secondary me-1">Cancel</a>
					</div>
				</div>
			</form>

			<form method="POST" action="{{ route('printreport.payment') }}" accept-charset="UTF-8" id="incomesales" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
				@csrf
				<div class="card">
					<div class="card-header">Income Report</div>
					<div class="card-body">

						<div class="form-group row m-1 @error('from2') has-error @enderror">
							<label for="from3" class="col-form-label col-sm-2">From : </label>
							<div class="col-sm-6 my-auto">
								<input type="text" name="from2" value="{{ old('from2', @$variable->from2) }}" id="from3" class="form-control form-control-sm @error('from2') is-invalid @enderror" placeholder="From">
								@error('from2')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="form-group row m-1 @error('to2') has-error @enderror">
							<label for="to3" class="col-form-label col-sm-2">To : </label>
							<div class="col-sm-6 my-auto">
								<input type="text" name="to2" value="{{ old('to2', @$variable->to2) }}" id="to3" class="form-control form-control-sm @error('to2') is-invalid @enderror" placeholder="To">
								@error('to2')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="form-group row m-1 @error('user2.*') has-error @enderror">
							<label for="seller2" class="col-form-label col-sm-2">Merchandiser : </label>
							<div class="col-sm-6 my-auto">
								<select name="user2[]" id="seller2" class="form-select form-select-sm col-sm-12 @error('user2') is-invalid @enderror" multiple></select>
								@error('user2.*')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

					</div>
					<div class="card-footer d-flex justify-content-end">
						<button type="submit" class="btn btn-sm btn-outline-primary me-1"><i class="fa-regular fa-floppy-disk"></i> Submit</button>
						<a href="{{-- route('banks.index') --}}" class="btn btn-sm btn-outline-secondary me-1">Cancel</a>
					</div>
				</div>
			</form>




		</div>
	</div>
</div>

@endsection


@section('js')
window.data = {
	routes: {
		getUser: '{{ route('getUser') }}',
	},
	url: {

	},
	old: {
		id_user: `{{ old('id_user', @$sales->id_user) }}`,
		user: `{{ old('user', @$sales->id_user) }}`,
		juser: @json(old('user', @$sales->id_user)),
	},
};
@endsection

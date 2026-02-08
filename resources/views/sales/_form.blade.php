<?php
if(\Auth::user()->id_group == 1) {
	$user = \App\Models\User::all();
} else {
	$user = \App\Models\User::find(Auth::user()->id);
}
?>
<div class="card mb-2">
	<div class="card-header">User</div>
	<div class="card-body">
		<div class="form-group row m-1 @error('id_user') has-error @enderror">
			<label for="us" class="col-form-label col-sm-2">User : </label>
			<div class="col-sm-6 my-auto">
				<select name="id_user" id="us" class="form-select form-select-sm col-sm-12 @error('id_user') is-invalid @enderror"></select>
				@error('id_user')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
		</div>
	</div>
</div>

<div class="card mb-2">
	<div class="card-header">Postage Slip</div>
	<div class="card-body">

		<div class="form-group row m-1 @error('date_sale') has-error @enderror">
			<label for="da" class="col-form-label col-sm-2">Date : </label>
			<div class="col-sm-6 my-auto">
				<input type="text" name="date_sale" value="{{ old('date_sale', @$sale->date_sale?->format('Y-m-d')) }}" id="da" class="form-control form-control-sm @error('date_sale') is-invalid @enderror" placeholder="Date">
				@error('date_sale')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
		</div>

		<div id="serial_wrap" class="col-sm-12">
		</div>

		<div>
			<button id="serial_add" class="add_serial btn btn-sm btn-primary" type="button">
				<i class="fas fa-plus"></i>&nbsp;Add Postage Tracking
			</button>
		</div>

		<div class="form-group row m-1 @error('image.*') has-error @enderror">
			<label for="img" class="col-form-label col-sm-2">Image : </label>
			<div class="col-sm-6 my-auto">
				<input type="file" name="image[]" value="{{ old('image', @$sale->image) }}" id="img" class="form-control form-control-sm @error('image.*') is-invalid @enderror" placeholder="Image" multiple>
				@error('image.*')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
				@enderror
			</div>
		</div>

	</div>
</div>

<div class="card mb-2">
	<div class="card-header">Customer</div>
	<div class="card-body">

		<p class="text-justify">Please fill up only 1 section. Select your <span style="color: red;">Returning Customer</span> or <span style="color: red;">New Customer</span>, but please dont fill both section.</p>
		<div class="card mb-2">
			<div class="card-header">Returning Customer</div>
			<div class="card-body">

				<div class="form-group row m-1 @error('repeatcust') has-error @enderror">
					<label for="custsel" class="col-sm-3 col-form-label">Select Existing Customer : </label>
					<div class="col-sm-9 my-auto">
						<select name="repeatcust" id="custsel" class="form-select form-select-sm @error('repeatcust') is-invalid @enderror"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="rt" class="col-sm-3 control-label" >Customer Info :</label>
					<div class="col-sm-9">
						<span id="client"></span>
						<br />
						<span id="address"></span>
						<br />
						<span id="poskod"></span>
						<br />
						<span id="phone"></span>
						<br />
						<span id="email"></span>
					</div>
				</div>
			</div>
		</div>



		<div class="card mb-2">
			<div class="card-header">New Customer</div>
			<div class="card-body">

				<div class="form-group row m-1 @error('client') has-error @enderror">
					<label for="pel" class="col-form-label col-sm-2">Customer : </label>
					<div class="col-sm-6 my-auto">
						<input type="text" name="client" value="{{ old('client', @$sale->client) }}" id="pel" class="form-control form-control-sm @error('client') is-invalid @enderror" placeholder="Customer">
						@error('client')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>

				<div class="form-group row m-1 @error('client_address') has-error @enderror">
					<label for="apel" class="col-form-label col-sm-2">Customer Address : </label>
					<div class="col-sm-6 my-auto">
						<textarea name="client_address" id="apel" class="form-control form-control-sm col-sm-12 @error('client_address') is-invalid @enderror" placeholder="Customer Address">{{ old('client_address', @$sale->client_address) }}</textarea>
						@error('client_address')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>

				<div class="form-group row m-1 @error('client_poskod') has-error @enderror">
					<label for="pos" class="col-form-label col-sm-2">Postcode : </label>
					<div class="col-sm-6 my-auto">
						<input type="text" name="client_poskod" value="{{ old('client_poskod', @$sale->client_poskod) }}" id="pos" class="form-control form-control-sm @error('client_poskod') is-invalid @enderror" placeholder="Postcode">
						@error('client_poskod')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>

				<div class="form-group row m-1 @error('client_phone') has-error @enderror">
					<label for="tel" class="col-form-label col-sm-2">Phone : </label>
					<div class="col-sm-6 my-auto">
						<input type="text" name="client_phone" value="{{ old('client_phone', @$sale->client_phone) }}" id="tel" class="form-control form-control-sm @error('client_phone') is-invalid @enderror" placeholder="Phone">
						@error('client_phone')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>

				<div class="form-group row m-1 @error('client_email') has-error @enderror">
					<label for="tela" class="col-form-label col-sm-2">Email : </label>
					<div class="col-sm-6 my-auto">
						<input type="text" name="client_email" value="{{ old('client_email', @$sale->client_email) }}" id="tela" class="form-control form-control-sm @error('client_email') is-invalid @enderror" placeholder="Email">
						@error('client_email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
				</div>



			</div>
		</div>

	</div>
</div>

<div class="card mb-2">
	<div class="card-header">Add Invoice Item</div>

	<div id="invItems_wrap"></div>

	<div class="col-sm-12 row">

		<div class="col-sm-5 m-0 my-auto">
			<strong>Tax</strong>
		</div>

		<div class="col-sm-5 m-0 my-auto">
			<select name="tax" id="taxs" multiple="multiple">
				<option value="">Choose Tax</option>
				@foreach(\App\Models\Taxes::all() as $r) :
				<option value="{!! $r->id !!}" data-amount="{!! $r->amount !!}" {{ (old('tax', @$sale?->salestaxes()->first()->id_tax) == $r->id)?'selected':NULL }}>{!! $r->tax !!}</option>
				@endforeach
			</select>
		</div>

		<div class="col-sm-2 m-0 my-auto  text-right">
			<span id="total_tax">0.00</span>%
		</div>

	</div>

	<div class="col-sm-12 row">

		<div class="col-sm-10">
			<strong>Total Amount</strong>
		</div>

		<div class="col-sm-2 text-right">
			<strong id="total_amount">0.00</strong>
		</div>

	</div>


	<div class="col-sm-12">
			<button class="btn btn-sm btn-outline-primary add_field" id="invItems_add" type="button">
				<i class="fas fa-plus"></i>&nbsp;Add Products
			</button>
	</div>
</div>


<div class="card mb-2">
	<div class="card-header">AddPayment</div>
	<div class="card-body">
		<div id="payment_wrap">	</div>

		<div class="col-sm-12 row">
			<div class="col-sm-10">
				<strong>Total Payment</strong>
			</div>

			<div class="col-sm-2 text-right">
				RM<strong id="total_payment">0.00</strong>
			</div>

		</div>

		<div class="col-sm-12 row">

			<div class="col-sm-10">
				<strong>Balance</strong>
			</div>

			<div class="col-sm-2 text-right">
				RM<strong id="balance">0.00</strong>
			</div>

		</div>

		<div class="col-sm-12">
			<button id="payment_add" class="btn btn-sm btn-primary" type="button">
				<i class="fas fa-plus"></i>&nbsp;Add Payment
			</button>
		</div>

	</div>

</div>



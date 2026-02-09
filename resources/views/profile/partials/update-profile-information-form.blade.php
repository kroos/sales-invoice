
		<h2 >
			{{ __('Profile Information') }}
		</h2>

		<p>
			{{ __("Update your account's profile information and email address.") }}
		</p>

	<form id="send-verification" method="post" action="{{ route('verification.send') }}">
		@csrf
	</form>

	<form method="post" action="{{ route('profile.update') }}" >
		@csrf
		@method('patch')

		<div class="form-group row m-2 @error('name') has-error @enderror">
			<label for="name" class="col-sm-4 col-form-label col-form-label-sm">Name : </label>
			<div class="col-sm-8">
				<input type="text" name="name" id="name" value="{{ old('name', @$user->name) }}" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Name">
				@error('name') <div class="invalid-feedback fw-lighter">{{ $message }}</div> @enderror
			</div>
		</div>

		<div class="form-group row m-2 {{ $errors->has('email') ? 'has-error' : '' }}">
			<label for="email" class="col-sm-4 col-form-label col-form-label-sm">Email : </label>
			<div class="col-sm-8">
				<input type="text" name="email" id="email" value="{{ old('email', @$user->email) }}" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Email">
				@error('email') <div class="invalid-feedback fw-lighter">{{ $message }}</div> @enderror
			</div>
			@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
				<div>
					<p class="tw-text-sm tw-mt-2 tw-text-gray-800">
						{{ __('Your email address is unverified.') }}

						<button form="send-verification" class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500">
							{{ __('Click here to re-send the verification email.') }}
						</button>
					</p>

					@if (session('status') === 'verification-link-sent')
						<p class="mt-2 tw-font-medium tw-text-sm tw-text-green-600">
							{{ __('A new verification link has been sent to your email address.') }}
						</p>
					@endif
				</div>
			@endif
		</div>

		<div class="form-group row m-2 @error('color') has-error @enderror">
			<label for="color" class="col-sm-4 col-form-label col-form-label-sm">Color : </label>
			<div class="col-sm-8">
				<input type="text" name="color" id="color" value="{{ old('color', @$user->color) }}" class="form-control form-control-sm @error('color') is-invalid @enderror" placeholder="Color">
				@error('color') <div class="invalid-feedback fw-lighter">{{ $message }}</div> @enderror
			</div>
		</div>

		<div class="col-sm-12 justify-self-end m-4">
			<button type="submit" class="btn btn-sm btn-primary m-3">
				{{ __('Save') }}
			</button>
			@if (session('status') === 'profile-updated')
				<p class="tw-text-sm tw-text-gray-600">{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>

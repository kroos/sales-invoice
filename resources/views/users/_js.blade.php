window.data = {
	route: {
		getUser: '{{ route('getUser') }}',
		remoteuser: '{{ route('remote.user') }}',
	},
	url: {},
	old: {
		id_group: @json(old('id_group', @$user->id_group)),
	},
};


const { route, url, old } = window.data;

$(`#own`).select2({
	... config.select2,
	ajax: {
		url: route.getUser,
		type: 'GET',
		dataType: 'json',
		delay: 250,											// Delay to reduce server requests
		data: function (params) {
			return {
				search: params.term,
			}
		},
		processResults: function (data) {
			return {
				results: data.map(function (category) {
					return {
						// id: category.id,
						text: category.group,
						disabled: true,
						children: category.users.map(function (users) {
							return {
								id: users.id,
								text: users.name,
							};
						})

					}
				})
			};
		}

	},
});

$(`#cpic`).select2({
	... config.select2,
	ajax: {
		url: route.getUser,
		type: 'GET',
		dataType: 'json',
		delay: 250,											// Delay to reduce server requests
		data: function (params) {
			return {
				search: params.term,
			}
		},
		processResults: function (data) {
			return {
				results: data.map(function (category) {
					return {
						text: category.group,
						disabled: true,
						children: category.users.map(function(users) {
							return {
								id: users.id,
								text: users.name,
							};
						})

					}
				})
			};
		}

	},
});

if(old.company_person_in_charge){
$.ajax({
	url: route.getUser,
	data: {
		id: `${old.company_person_in_charge}`
	},
	dataType: 'json'
}).then(data => {
	const selectedId = `${old.company_person_in_charge}`;

	data.forEach(group => {
		group.users?.forEach(user => {
			if (String(user.id) === String(selectedId)) {
				const option = new Option(user.name, user.id, true, true);
				$('#cpic').append(option).trigger('change');
			}
		});
	});
});
}

if(old.company_owner){
$.ajax({
	url: route.getUser,
	data: {
		id: `${old.company_owner}`
	},
	dataType: 'json'
}).then(data => {
	const selectedId = `${old.company_owner}`;

	data.forEach(group => {
		group.users?.forEach(user => {
			if (String(user.id) === String(selectedId)) {
				const option = new Option(user.name, user.id, true, true);
				$('#own').append(option).trigger('change');
			}
		});
	});
});
}


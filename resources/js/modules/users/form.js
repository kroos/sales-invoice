const {	route, 	url, 	old } = 	window.data;
$('#rgba').minicolors({
	format: 'rgb',
	opacity: true,
	theme: 'bootstrap',
});

$(`#ug`).select2({
	...config.datatable,
	ajax: {
		url: route.getUser,
		type: 'GET',
		dataType: 'json',
		delay: 250,											// Delay to reduce server requests
		data: function (params) {
			return {
				search: params.term,				// Search query
				idIn: [],
				id: old.id_group,
			}
		},
		processResults: function (data) {
			return {
				results: data.map(function (category) {
					return {
						id: category.id,
						text: category.group,
					}
				})
			};
		}
	},
});
if(old.id_group){
$.ajax({
	url: route.getUser,
	data: {
		id: old.id_group
	},
	dataType: 'json'
}).then(data => {
	if (!Array.isArray(data)) return;

	data.forEach(group => {
		if (!Array.isArray(group.users)) return;
		const option = new Option(group.group, group.id, true, true);
		$('#ug').append(option);
	});
	$('#ug').trigger('change'); // trigger once
});
}

// bootstrap validator
$("#form").bootstrapValidator({
	fields: {
		name: {
			validators: {
				notEmpty: {
					message: 'Please insert your name. '
				}
			}
		},
		email: {
			validators: {
				notEmpty: {
					message: 'Please insert your email. '
				},
				regexp: {
					regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
					message: 'Please insert your valid email address. '
				},
				remote: {
					// type: 'POST',
					url: route.remoteuser,
					message: 'Please use another email. ',
					delay: 50
				},
			}
		},
		username: {
			message: 'The username is not valid',
			validators: {
				notEmpty: {
					message: 'The username is required and cannot be empty'
				},
				stringLength: {
					min: 6,
					max: 10,
					message: 'The username must be more than 6 and less than 10 characters long'
				},
				regexp: {
					regexp: /^[a-zA-Z0-9_]+$/,
					message: 'The username can only consist of alphabetical, number and underscore'
				},
				remote: {
					// type: 'POST',
					url: route.remoteuser,
					message: 'Please use another username. ',
					delay: 50
				},
			}
		},
		password: {
			validators: {
				notEmpty: {
					message: 'Please insert your password. '
				},
				regexp: {
					regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/,
					message: 'Passwords are 8-16 characters with uppercase letters, lowercase letters and at least one number. '
				},
			}
		},
		password_confirmation: {
			validators: {
				notEmpty: {
					message: 'Please insert your confirmation password. '
				},
				identical: {
					field: 'password',
					message: 'The password and its confirmation are not the same. '
				}
			}
		},
		id_group: {
			validators: {
				notEmpty: {
					message: 'Please choose an option. '
				}
			}
		},
		color: {
			validators: {
				notEmpty: {
					message: 'Please choose a color. '
				}
			}
		},
	}
});


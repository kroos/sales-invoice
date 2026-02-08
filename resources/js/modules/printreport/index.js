const {routes, old} = window.data;

////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(`#seller,#seller1,#seller2`).select2({
	...config.select2,
	ajax: {
		url: routes.getUser,
		type: 'GET',
		dataType: 'json',
		delay: 250,											// Delay to reduce server requests
		data: function (params) {
			return {
				search: params.term,				// Search query
				idIn: [],
				id: old.id_user,
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
if(old.juser){
$.ajax({
	url: routes.getUser,
	data: {
		id: old.user
	},
	dataType: 'json'
}).then(data => {
	if (!Array.isArray(data)) return;

	data.forEach(group => {
		if (!Array.isArray(group.users)) return;

		group.users.forEach(user => {
			const option = new Option(user.name, user.id, true, true);
			$('#seller,#seller1,#seller2').append(option);
		});
	});

	$('#seller,#seller1,#seller2').trigger('change'); // trigger once
});
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Date Input Helper
$('#from1').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,   // month dropdown
	changeYear: true,    // year dropdown
	showButtonPanel: true
}).on('change', function () {
	$('#salesform').bootstrapValidator('revalidateField', 'from');
	$('#to1').datepicker('option', 'minDate', this.value);
});

$('#to1').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,   // month dropdown
	changeYear: true,    // year dropdown
	showButtonPanel: true
})
.on('change', function(e) {
	$('#salesform').bootstrapValidator('revalidateField', 'to');
	$('#from1').datepicker('option', 'maxDate', this.value);
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// validator
$('#salesform').bootstrapValidator({
	fields: {
		from: {
			validators: {
				notEmpty: {
					message: 'Please insert date. '
				},
				date: {
					message: 'The date is not valid',
					format: 'YYYY-MM-DD'
				},
			}
		},
		to: {
			validators: {
				notEmpty: {
					message: 'Please choose date. '
				},
				date: {
					message: 'The date is not valid',
					format: 'YYYY-MM-DD'
				},
			}
		},
		'user[]': {
			validators: {
				notEmpty: {
					message: 'Please choose merchandiser. '
				}
			}
		}
	}
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Date Input Helper
$('#from2').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,   // month dropdown
	changeYear: true,    // year dropdown
	showButtonPanel: true
})
.on('change', function(e) {
	$('#auditsales').bootstrapValidator('revalidateField', 'from1');
	$('#to2').datepicker('option', 'minDate', this.value);
});

$('#to2').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,   // month dropdown
	changeYear: true,    // year dropdown
	showButtonPanel: true
})
.on('change', function(e) {
	$('#auditsales').bootstrapValidator('revalidateField', 'to1');
	$('#from2').datepicker('option', 'minDate', this.value);
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// validator
$('#auditsales').bootstrapValidator({
	fields: {
		from1: {
			validators: {
				notEmpty: {
					message: 'Please insert date. '
				},
				date: {
					message: 'The date is not valid',
					format: 'YYYY-MM-DD'
				},
			}
		},
		to1: {
			validators: {
				notEmpty: {
					message: 'Please choose date. '
				},
				date: {
					message: 'The date is not valid',
					format: 'YYYY-MM-DD'
				},
			}
		},
		'user1[]': {
			validators: {
				notEmpty: {
					message: 'Please choose merchandiser. '
				}
			}
		}
	}
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Date Input Helper
$('#from3').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,   // month dropdown
	changeYear: true,    // year dropdown
	showButtonPanel: true
})
.on('change', function(e) {
	$('#incomesales').bootstrapValidator('revalidateField', 'from2');
	$('#to3').datepicker('option', 'minDate', this.value);
});

$('#to3').datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,   // month dropdown
	changeYear: true,    // year dropdown
	showButtonPanel: true
})
.on('change', function(e) {
	$('#incomesales').bootstrapValidator('revalidateField', 'to2');
	$('#from3').datepicker('option', 'minDate', this.value);
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// validator
$('#incomesales').bootstrapValidator({
	fields: {
		from2: {
			validators: {
				notEmpty: {
					message: 'Please insert date. '
				},
				date: {
					message: 'The date is not valid',
					format: 'YYYY-MM-DD'
				},
			}
		},
		to2: {
			validators: {
				notEmpty: {
					message: 'Please choose date. '
				},
				date: {
					message: 'The date is not valid',
					format: 'YYYY-MM-DD'
				},
			}
		},
		'user2[]': {
			validators: {
				notEmpty: {
					message: 'Please choose merchandiser. '
				}
			}
		}
	}
});

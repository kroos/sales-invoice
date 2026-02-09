$("#form").bootstrapValidator({
	fields: {
		category: {
			validators: {
				notEmpty: {
					message: 'Please insert category name. '
				},
			}
		},
	}
})

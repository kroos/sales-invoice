const { routes, urls, productid } = window.data;

// select2
$(`#cat`).select2({
	...config.select2,
	ajax: {
		url: routes.getProducts,
		type: 'GET',
		dataType: 'json',
		delay: 250,											// Delay to reduce server requests
		data: function (params) {
			return {
				search: params.term,				// Search query
			}
		},
		processResults: function (data) {
			return {
				results: data.map(function (category) {
					return {
						id: category.id,
						text: category.product_category,

					}
				})
			};
		}

	},
});
if(olds.id_category){
	$.ajax({
		url: routes.getProducts,
		data: {
			id: olds.id_category
		},
		dataType: 'json'
	}).then(data => {
			const option = new Option(data[0].product_category, data[0].id, true, true);
			$('#cat').append(option).trigger('change');
	});
}

// bootstrap validator
$("#form").bootstrapValidator({
	fields: {
		product: {
			validators: {
				notEmpty: {
					message: 'Please insert product name. '
				},
			}
		},
		retail: {
			validators: {
				notEmpty: {
					message: 'Please insert retail price. '
				},
				greaterThan: {
					value: 0,
					message: 'The retail price should be greater than 0. '
				}
			}
		},
		commission: {
			validators: {
				notEmpty: {
					message: 'Please insert commission. '
				},
				greaterThan: {
					value: 0,
					message: 'The commssion should be greater than 0. '
				}
			}
		},
		'image[]': {
			validators: {
				notEmpty: {
					message: 'Please select an image'
				},
				file: {
					extension: 'jpeg,jpg,png,bmp',
					type: 'image/jpeg,image/png,image/bmp',
					maxSize: 7990272,   // 3264 * 2448
					message: 'The selected file is not valid. It should be 3264X2448 max dimension. '
				}
			}
		},
		id_category: {
			validators: {
				notEmpty: {
					message: 'Please choose an category for the product. '
				}
			}
		},
	}
})


var table = $('#at').DataTable({
	...config.datatable,
	ajax: {
		type: 'GET',
		url: routes.getProductsdT,
		dataSrc: '',
		data: {
			id: productid
		},
	},
	columns: [
		{
			data: null,
			title: 'ID',
			defaultContent: '-',
			render: function (data, type, row) {
				return row.productimage[0].id;
			}
		},
		{
			data: null,
			title: 'Image',
			defaultContent: '-',
			render: function (data, type, row) {
				return `
					<img src="data:${row.productimage[0].mime};base64, ${row.productimage[0].image}" class="img-responsive img-rounded">
				`;
			}
		},
		{
			data: 'productimage[0].id',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data){
				return `
					<div class="btn-group btn-group-sm" role="group">
						<a href="${urls.productimages}/${data}/edit" class="btn btn-sm btn-outline-info" title="Edit">
							<i class="fa-regular fa-pen-to-square"></i>
						</a>

						<button type="button" data-id="${data}" title="Delete" class="remove btn btn-sm btn-danger">
							<i class="fas fa-trash fa-lg"></i>
						</button>
					</div>
				`;
			}
		}
	],
	initComplete: function(settings, response) {
		// console.log(settings);
		$(document).on('click', '.remove', function(e){
			var productId = $(this).data('id');
			SwalDelete(productId);
			e.preventDefault();
		});
	}
});


// ajax post delete row

function SwalDelete(productId){
	swal.fire({

		...config.swal,
		confirmButtonText: '<i class="fa fa-trash-o" aria-hidden="true"></i>	Yes, delete it!',

		preConfirm: function()                {
			return new Promise(function(resolve) {
				$.ajax({
					url: `${urls.productimages}/${productId}`,
					type: 'DELETE',
					data:	{
								id: productId,
							},
					dataType: 'json'
				})
				.done(function(response){
					swal.fire('Deleted!', response.message, response.status);
					table.ajax.reload();
				})
				.fail(function(){
					swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
				});
			});
		},
	})
	.then((result) => {
		if (result.dismiss === swal.DismissReason.cancel) {
			swal.fire('Cancelled','Your data is safe.','info')
		}
	});
};

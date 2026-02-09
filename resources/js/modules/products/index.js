const { routes, urls } = window.data;

var table = $('#at').DataTable({
	...config.datatable,
	ajax: {
		type: 'GET',
		url: routes.getProductsdT,
		dataSrc: '',
		data: function(da){
		},
	},
	columns: [
		{ data: 'id', title: 'ID', defaultContent: '-', },
		{ data: 'category.product_category', title: 'Category', defaultContent: '-', },
		{ data: 'product', title: 'Product', defaultContent: '-', },
		{
			data: 'retail',
			title: 'Retail',
			defaultContent: '-',
			render: function (data, type, row) {
			 	return data;
			}
		},
		{
			data: 'commission',
			title: 'Commission',
			defaultContent: '-',
			 render: function (data, type, row) {
			 	return data;
			}
		},
		{
			data: 'active',
			title: 'Active',
			defaultContent: '-',
			 render: function (data, type, row) {
			 	if(data == 1){
			 		var act = 'Active';
			 		var clas = 'text-white bg-success';
			 	} else {
			 		var act = 'Inactive';
			 		var clas = 'text-white bg-danger';
			 	}
			 	return `
			 		<span class="${clas}">${act}</span>
			 	`;
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
			data: 'slug',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data){
				return `
					<div class="btn-group btn-group-sm" role="group">
						<a href="${urls.products}/${data}/edit" class="btn btn-sm btn-outline-info" title="Edit">
							<i class="fa-regular fa-pen-to-square"></i>
						</a>

						<button type="button" data-id="${data}" title="Delete" class="delete_button btn btn-sm btn-danger">
							<i class="fas fa-trash"></i>
						</button>
					</div>
				`
			}
		}
	],
	initComplete: function(settings, response) {
		console.log(response); // This runs after successful loading
		$(document).on('click', '.delete_button', function(e){
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
		preConfirm: function() {
			return new Promise(function(resolve) {
				$.ajax({
					url: `${urls.productsdestroy}/${productId}`,
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


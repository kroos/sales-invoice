const { routes, urls, olds } = window.data;


var table = $('#at').DataTable({
	...config.datatable,
	order: [[0, 'asc'], [1, 'asc']],
	// dom: 'Bfrtip',
	ajax: {
		type: 'GET',
		url: routes.getProducts,
		dataSrc: '',
		data: function(da){
			da._token = '{!! csrf_token() !!}'
		},
	},
	columns: [
		{ data: 'id', title: 'ID', defaultContent: '-', },
		{ data: 'product_category', title: 'Product Category', defaultContent: '-', },
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
			data: 'id',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data){
				return `
					<div class="btn-group btn-group-sm" role="group">
						<a href="${urls.productcategories}/${data}/edit" class="btn btn-sm btn-outline-info" title="Edit">
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
		preConfirm: function(){
			return new Promise(function(resolve) {
				$.ajax({
					url: '${urls.productcategories}/${productId}',
					type: 'delete',
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
				console.log()
			});
		},
	});
}

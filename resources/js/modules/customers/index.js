const { route, url, old } = window.data;
var table = $('#at').DataTable({
	...config.datatable,
	ajax: {
		type: 'GET',
		url: route.getCustomers,
		dataSrc: '',
		data: function(da){
		},
	},
	columns: [
		{ data: 'id', title: 'ID', defaultContent: '-', },
		{ data: 'client', title: 'Name', defaultContent: '-', },
		{ data: 'client_address', title: 'Address', defaultContent: '-', },
		{ data: 'client_poskod', title: 'Postcode', defaultContent: '-', },
		{ data: 'client_phone', title: 'Phone', defaultContent: '-', },
		{ data: 'client_email', title: 'Email', defaultContent: '-', },
		{
			data: 'id',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data){
				return `
					<div class="btn-group btn-group-sm" role="group">
						<a href="${url.customers}/${data}/edit" class="btn btn-sm btn-outline-info" title="Edit">
							<i class="fa-regular fa-pen-to-square"></i>
						</a>

						<button type="button" data-id="${data}" title="Delete" class="delete_button btn btn-sm btn-danger">
							<i class="fas fa-trash fa-lg"></i>
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
					url: `${url.customers}/${productId}`,
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
				console.log()
			});
		},
	});
}


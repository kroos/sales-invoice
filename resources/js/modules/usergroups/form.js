const { routes, urls, olds } = window.data;
var table = $('#at').DataTable({
	...config.datatable,
	ajax: {
		type: 'GET',
		url: routes.getUser,
		data: function(da){
		},
		dataSrc: '',
	},
	columns: [
		{ data: 'id', title: 'ID', defaultContent: '-', },
		{ data: 'group', title: 'Group', defaultContent: '-', },
		{
			data: 'id',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data){
				return `
					<div class="btn-group btn-group-sm" role="group">
						<button type="button" data-id="${data}" title="Delete" class="delete_button btn btn-sm btn-outline-danger">
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
					url: `${urls.usergroups}/${productId}`,
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



const {	route, url, old } = window.data;
var table = $('#at').DataTable({
	...config.datatable,
	ajax: {
		type: 'GET',
		url: route.getBanksT,
		dataSrc: '',
		data: function(da){
		},
	},
	columns: [
		{ data: 'id', title: 'ID', defaultContent: '-', },
		{ data: 'bank', title: 'Bank', defaultContent: '-', },
		{ data: 'city', title: 'City', defaultContent: '-', },
		{ data: 'swift_code', title: 'Swift Code', defaultContent: '-', },
		{ data: 'account', title: 'Account', defaultContent: '-', },
		{
			data: null,
			title: 'Status',
			defaultContent: '-',
			render: function(data, type, row){
				if(row.active == 1) {
					var clas = 'btn-success';
					var word = 'Active';
				} else {
					var clas = 'btn-danger';
					var word = 'Inactive';
				}

				return `
					<a href="${url.banks}/active/${row.id}" class="btn btn-sm text-white ${clas}">${word}</a>
				`;
			}
		},
		{
			data: 'id',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data, type, row){
				return `
					<div class="btn-group btn-group-sm" role="group">
						<a href="${url.banks}/${data}/edit" class="btn btn-sm btn-outline-info" title="Edit">
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

function SwalDelete(productId){
	swal.fire({
		...config.swal,
		preConfirm: function(){
			return new Promise(function(resolve) {
				$.ajax({
					url: `${url.banks}/${productId}`,
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


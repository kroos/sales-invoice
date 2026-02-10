const { route, url, old } = window.data;
var table = $('#at').DataTable({
	...config.datatable,
	ajax: {
		type: 'GET',
		url: route.getUser,
		data: function(da){
		},
		dataSrc: function (json) {
			let rows = [];

			json.forEach(group => {
				group.users.forEach(user => {
					rows.push({
						group_id: group.id,
						group: group.group,
						user_id: user.id,
						name: user.name,
						slug: user.slug,
						username: user.username,
						email: user.email,
						color: user.color
					});
				});
			});

			return rows;
		}
	},
	columns: [
		{ data: 'user_id', title: 'ID' },
		{ data: 'group', title: 'Group' },
		{ data: 'name', title: 'Name' },
		{ data: 'username', title: 'Username' },
		{ data: 'email', title: 'Email' },
		{
			data: 'color',
			title: 'Color',
			orderable: false,
			searchable:false,
			render: function(data,type,row){
				return `
					<span class="badge"
					style="background:${data}; color:#fff;">
					${data}
				</span>
				`;
			}
		},
		{
			data: 'user_id',
			title: '#',
			orderable: false,
			searchable:false,
			render: function(data,type,row){
				if(data == 1){
					var del = 0;
				} else {
					var del = data;
				}
				return `
					<div class="btn-group btn-group-sm" role="group">
						<a href="${url.users}/${row.slug}/edit" class="btn btn-sm btn-outline-info" title="Edit">
							<i class="fa-regular fa-pen-to-square"></i>
						</a>

						<button type="button" data-id="${del}" title="Delete" class="delete_button btn btn-sm btn-danger">
							<i class="fa-regular fa-trash-can"></i>
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
					url: `${url.user}/${productId}`,
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


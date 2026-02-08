const {routes, user} = window.data;

const res = $.ajax({
	url: routes.getStaffSales,
	dataType: 'json',
	data:{
	},
})
.done(function(data){
	console.log(data);
	const retail = normalizeStaffSales(data);
	 renderStaffSales(retail);
	const commission = normalizeStaffCommission(data);
	renderStaffCommission(commission);
	const product = normalizeStaffProduct(data);
	renderStaffProduct(product);
});

function normalizeStaffSales(data) {
	const months = Object.keys(data).sort();

	const users = {};

	months.forEach(month => {
		data[month].forEach(row => {
			const userId = row.user.name;


			if (!users[userId]) {
				users[userId] = {
					label: `${userId}`,
					borderColor: row.user.color,
					backgroundColor: row.user.color,
					fill: false,
					data: Array(months.length).fill(0)
				};
			}

			const monthIndex = months.indexOf(month);
						users[userId].data[monthIndex] = row.total_retail; // or total_commission
					});
	});

	return {
		labels: months,
		datasets: Object.values(users)
	};
}

function normalizeStaffCommission(data) {
	const months = Object.keys(data).sort();

	const users = {};

	months.forEach(month => {
		data[month].forEach(row => {
			const userId = row.user.name;

			if (!users[userId]) {
				users[userId] = {
					label: `${userId}`,
					borderColor: row.user.color,
					backgroundColor: row.user.color,
					fill: false,
					data: Array(months.length).fill(0)
				};
			}

			const monthIndex = months.indexOf(month);
						users[userId].data[monthIndex] = row.total_commission; // or total_commission
					});
	});

	return {
		labels: months,
		datasets: Object.values(users)
	};
}

function normalizeStaffProduct(data) {
	const months = Object.keys(data).sort();
		const productDatasets = {}; // { productName: { label, data[], ... } }

		months.forEach((month, monthIndex) => {
			data[month].forEach(row => {
				const userName = row.user.name;
				const userColor = row.user.color;

						// row.product_quantities is an object: { "T-Shirt": 3, "Jeans": 2 }
				for (const [productName, quantity] of Object.entries(row.product_quantities)) {

								// Use "Officer + product" as label to differentiate
					const key = `${userName} - ${productName}`;

					if (!productDatasets[key]) {
						productDatasets[key] = {
							label: key,
							borderColor: userColor,
							backgroundColor: userColor,
							fill: false,
							tension: 0.4,
							data: Array(months.length).fill(0)
						};
					}

					productDatasets[key].data[monthIndex] = quantity;
				}
			});
		});

		return {
			labels: months,
			datasets: Object.values(productDatasets)
		};
	}


async function renderStaffSales(data) {

	new Chart(document.getElementById('myChart'), {
		type: 'line',
		data: {
			labels: data.labels,
			datasets: data.datasets.map(ds => ({
				...ds,
				tension: 0.4
			}))
		},
		options: {
			responsive: true,
			title:
			{
				display: true,
				text: 'Officer vs Sales'
			},
		}
	});
}


async function renderStaffCommission(data) {

	new Chart(document.getElementById('myChartcommission'), {
		type: 'line',
		data: {
			labels: data.labels,
			datasets: data.datasets.map(ds => ({
				...ds,
				tension: 0.4
			}))
		},
		options: {
			responsive: true,
			title:
			{
				display: true,
				text: 'Officer vs Commission'
			},
		}
	});
}

async function renderStaffProduct(data) {

	new Chart(document.getElementById('ProsoldPermonth'), {
		type: 'bar',
		data: {
			labels: data.labels,
			datasets: data.datasets.map(ds => ({
				...ds,
				tension: 0.4
			}))
		},
		options: {
			responsive: true,
			title:
			{
				display: true,
				text: 'Officer vs Products'
			},
		}
	});
}



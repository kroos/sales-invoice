@extends('layouts.app')

@section('content')
		<div class="card">
			<div class="card-header">Statistic</div>
			<div class="card-body">

				<p>&nbsp;</p>
				<div class="row">
					<div class="col-sm-12">
						<label for="myChart">Officer vs Sales</label>
						<canvas id="myChart" width="100%" height="100"></canvas>
					</div>
				</div>

				<p>&nbsp;</p>
				<div class="row">
					<div class="col-sm-12">
						<label for="myChartcommission">Officer vs Commission</label>
						<canvas id="myChartcommission" width="100%" height="100"></canvas>
					</div>
				</div>

				<p>&nbsp;</p>
				<div class="row">
					<div class="col-sm-12">
						<label for="ProsoldPermonth">Products Sold Per Month</label>
						<canvas id="ProsoldPermonth" width="100%" height="100"></canvas>
					</div>
				</div>

			</div>
		</div>

@endsection

@section('js')
window.data = {
	routes: {
		getStaffSales: '{{ route('getStaffSales') }}',
	},
	user: {
		id_group: '{{ \Auth::user()->id_group }}',
		name: '{{ \Auth::user()->name }}',
	},
};
@endsection

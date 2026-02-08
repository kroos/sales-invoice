try {
require('./jquery');

	require('bootstrap/dist/js/bootstrap.bundle');

	require('@fortawesome/fontawesome-free');

	require('datatables.net');
	require('datatables.net-bs5');
	require('datatables.net-autofill-bs5');
	require('datatables.net-colreorder-bs5');
	require('datatables.net-fixedheader-bs5');
	require('datatables.net-responsive-bs5');
	require('datatables.net-buttons-bs5');
	require('datatables.net-buttons/js/buttons.html5');
	require('datatables.net-buttons/js/buttons.print');
	require('datatables.net-buttons/js/buttons.colVis');
	require('jszip');
	require('pdfmake');
	require( 'pdfmake/build/vfs_fonts');

	require('select2');

	window.moment = require('moment');
	moment().format();

	require('bootstrapValidator5');

	window.swal = require ('sweetalert2');

	require('addremrow-validator5-swal2-ajax');

	require('./jquery-ui-prefix');

	require('./fullcalendar');

	require('./chart');

	// require('@claviska/jquery-minicolors');
	require('./minicolors');

	require('./dataTable-any-number');
	require('./dataTable-moment');

	require('./bootstrap');

	window.config = require('./config/plugins').default;
	// import config from './config/plugins';

} catch (e) {
	console.error('Error loading JavaScript dependencies:', e);
}

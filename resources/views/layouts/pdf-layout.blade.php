<?php
// \Auth::user()->setConnection('mysql3');
\Auth::user()->belongstostaff->unreadNotifications->markAsRead();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>{{ config('app.name', 'Laravel') }}</title>
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }
		@page { size: A4; margin: 0; }

		html, body {
			width: 210mm;
			height: 297mm;
			font-size: 12px;
			font-family: Arial, sans-serif;
		}

		/* Background */
		.bg {
			position: fixed;
			top: 0;
			left: 0;
			width: 210mm;
			height: 297mm;
			z-index: -1;
		}
		.bg img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			opacity: 0.15;
		}

		/* Header */
		.header {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			height: 25mm;
			text-align: center;
			font-size: 16px;
			font-weight: bold;
			border-bottom: 1px solid #ccc;
			padding-top: 6mm;
		}
		.header .logo {
			height: 15mm;
			vertical-align: middle;
			margin-right: 8px;
		}

		/* Footer */
		.footer {
			position: fixed;
			bottom: 10mm;
			left: 0;
			right: 0;
			text-align: center;
			font-size: 10px;
			color: #555;
		}
		.footer-box {
			display: inline-block;
			padding: 2px 10px;
			border: 1px solid #333;
			border-radius: 6px;
			background: #f9f9f9;
		}

		/* Main content */
		.content {
			margin-top: 32mm;
			margin-bottom: 20mm;
			padding: 0 15mm;
		}

		/* Paragraph styles with font size */
		p {
			font-size: 14px;
			line-height: 1.6;
			margin-bottom: 15px;
		}

		/* Bold and underline styles */
		.bold {
			font-weight: bold;
		}

		.red {
			color: red;
		}

		.underline {
			text-decoration: underline;
		}

		/* Unordered list styles */
		ul {
			list-style-type: disc;
			margin-left: 20px;
			margin-bottom: 15px;
			font-size: 14px; /* Set font size for unordered lists */
		}

		/* Ordered list styles */
		ol {
			list-style-type: decimal;
			margin-left: 20px;
			margin-bottom: 15px;
			font-size: 14px; /* Set font size for ordered lists */
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			font-size: 14px;
		}
		th, td {
			border: 1px solid #ccc;
			padding: 8px;
			text-align: left;
		}
		th {
			background-color: #d9e9ff;
		}
		tr:nth-child(even) {
			background-color: #f7f7f7;
		}
		.bold { font-weight: bold; }
		.red { color: red; }
		.center { text-align: center; }
	</style>
</head>
<body>
	<!-- Background -->
	<div class="bg">
		<img src="{{ public_path('images/background.jpg') }}" alt="background">
	</div>

	<!-- Header -->
	<div class="header">
		<img src="{{ public_path('images/logo.png') }}" class="logo">
		@yield('title', 'Document')
	</div>

	<!-- Content -->
	<div class="content">
		@yield('content')
	</div>

	<!-- Footer -->
	<div class="footer">
		<div class="footer-box">
			&copy; {{ config('app.name', 'Laravel') }} {{ $currentYear }}
		</div>
	</div>
</body>
</html>

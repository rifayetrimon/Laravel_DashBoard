<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Metronic </title>
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link rel="stylesheet" href="{{ asset("assets/backend/css/plugin.bundle.css") }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset("assets/backend/css/style.bundle.css") }}" type="text/css">
	</head>
	<body id="kt_body" class="bg-body">

        @yield('content')

		<script src="{{ asset("assets/backend/plugin.bundle.js") }}"></script>
		<script src="{{ asset("assets/backend/js/script.bundle.js") }}"></script>
		<script src="{{ asset("assets/backend/js/general.js") }}"></script>
	</body>
</html>
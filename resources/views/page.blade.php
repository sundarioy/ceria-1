<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Ceria</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap-grid.css') }}" rel="stylesheet">
	
	<!-- Font Awesome JS -->    
	<link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap-grid.css') }}" rel="stylesheet">
	
	<!-- Font Awesome JS -->    
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
	<script type="text/javascript">
		
		var username = sessionStorage.getItem('username');

		if (username === null) {
			window.location.replace("/home");
		}
	</script>
	<div id="app">
	</div>	 
	
	<script src="{{ asset('js/app.js') }}"></script>	
	<script src="{{ asset('bootstrap-4.3.1-dist/js/bootstrap.js') }}"></script>
	<script src="{{ asset('bootstrap-4.3.1-dist/js/bootstrap.min.js') }}"></script>	
	<!-- jQuery CDN - Slim version (=without AJAX) -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->	
</body>
</html>
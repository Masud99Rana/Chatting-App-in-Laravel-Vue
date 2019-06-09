<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		Hello, {{ $name }}
		<h1>Welcome to the Website !!</h1>
		<a href="{{ route('export.pdf') }}" class="btn btn-primary">Export</a>
		
	</div>
</body>
</html>
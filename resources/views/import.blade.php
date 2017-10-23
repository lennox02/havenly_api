<html lang="en">
<head>
	<title>HAVENLY - Import CSV via Laravel 5 API</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">HAVENLY - Import CSV via Laravel 5 API</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            <p>Import CSV file here to upload data to database.  Data with already existing skus will update the corresponding db row.</p>
			{{ csrf_field() }}
			<input type="file" name="import_file" /><br />
			<button class="btn btn-primary">Import File</button>
		</form>
	</div>
</body>
</html>

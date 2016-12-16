<html>
<head>
<title>SANDY</title>
</head>
<body>
	<form method="post" enctype= "multipart/form-data">
		 {{ csrf_field() }}

File
<br>
<br>
<input type="file" name ="video"/>
<br>
<br>

<input type="submit" value ="Go">
	</form>
</body>
</html>
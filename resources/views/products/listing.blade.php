<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product List</title>

	<style>
		h1{ text-align: center;}
		#app { padding: 5%;}
		form div {
			display: flex;
			justify-content: center;
			margin: 2%;
		}

		div#tableblock {
    justify-content: center;
    display: flex;
}
	</style>	
</head>
<body>
    <h1>PRODUCT LIST EXTERNAL</h1>
	<div id="app"></div>

	@vite('resources/js/app.js')
</body>
</html>
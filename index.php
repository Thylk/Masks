<!DOCTYPE html>
<html lang="fr">
	
<head>
	<META NAME="Author" CONTENT="Maxime Regnault">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Masks</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/index.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/footer.css">


	<?php 
	// $myFile = pathinfo(URL); 
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
    // echo "The current page name is: ".$curPageName;  
    //Show the file name 
    // echo $myFile['basename'], "\n"; 
		if($curPageName === 'index.php') {
			echo ('<link rel="stylesheet" type="text/css" href="assets/css/index.css">');
		}
	?>
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>
    
<?php include 'includes/header.php';?>

<main>
	
	<div id="container">

		<div id="bandeau-accueil">
			<h1 id="title">Vous êtes à la recherche d'un masque ?</h1>
			<h2 id="subtitle">On vous couvre !</h2>
		</div>

		<div id="intro-accueil">
			<div class="card">Fabriqué en France</div>
			<div class="card">100% fait mains</div>
			<div class="card">Lavables / Réutilisables</div>
		</div>

		<div id="btn-accueil">
			<button id="shop">Boutique</button>
		</div>

	</div>

</main>

<?php include 'includes/footer.php';?>

</body>

<script src="assets/js/menu.js"></script>

</html>
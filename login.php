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
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
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

		<h1 id="title">Login</h1>

		<form id="login-box" action="includes/login.inc.php" method="post">

            <div class="form-signup">
                <input class="form-input" type="text" name="mail" placeholder=" Email">
            </div>

            <div class="form-signup">
                <input class="form-input" type="text" name="pwd" placeholder=" Password">
            </div>

            <button type="submit" name="login-submit">Connexion</button>

            <p>Vous n'avez pas de compte?</p>

            <a href="register.php">Inscrivez-vous ici.</a>

        </form>

	</div>

</main>


</body>

<script src="assets/js/menu.js"></script>

</html>
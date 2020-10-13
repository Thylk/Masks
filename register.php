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
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
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

		<h1 id="title">Register</h1>

		<form id="register-box" action="includes/register.inc.php" method="post">
            <?php include 'includes/error.php';?>
            <div class="form-signup">
                <input class="form-input" type="text" name="mail" placeholder="<?php if (isset($_GET['mail'])) {echo ' '.$_GET['mail'].'';} else { echo ' Email';} ?>">
            </div>

			<!-- Changer en type password -->
            <div class="form-signup">
                <input class="form-input" type="text" name="pwd" placeholder=" Password">
            </div>

            <div class="form-signup">
                <input class="form-input" type="text" name="pwd-repeat" placeholder=" Confirm Password">
            </div>

            <button type="submit" name="signup-submit">S'inscrire</button>

            <p>Vous avez déjà un compte?</p>

            <a href="login.php">Connectez-vous ici.</a>

		</form>
		
	</div>

</main>


</body>

<script src="assets/js/menu.js"></script>

</html>
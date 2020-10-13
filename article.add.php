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
	<link rel="stylesheet" type="text/css" href="assets/css/article.add.css">
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

		<h1 id="title">Ajouter un article</h1>

		<div id="add-article-box">
			
                <form enctype="multipart/form-data" action="includes/article.add.inc.php" method="post">
                        
                        <div class="form-signup">
                            <input type="file" name="img">
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="nom" placeholder=" Nom">
                        </div>
                        <div class="form-signup">
                            <textarea class="form-input" type="text" name="descri" placeholder=" Description"></textarea>
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="taille" placeholder=" Taille"></input>
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="prix" placeholder=" Prix"></input>
                        </div>
                    
                    <button type="submit" name="signup-submit">Ajouter article</button>
                </form>
                <button id="close-add">Fermer</button>

		</div>

	</div>

</main>

</body>

<script src="assets/js/menu.js"></script>

</html>
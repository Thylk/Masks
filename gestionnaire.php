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
	<link rel="stylesheet" type="text/css" href="assets/css/gestionnaire.css">
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

		<h1 id="title">Gestionnaire boutique</h1>

		<div id="gestionnaire-box">

        <?php
				// Include config file
				require_once "includes/dbh.inc.php";
				
				// Attempt select query execution
				$sql = "SELECT * FROM articles ORDER BY id ASC";
				if($result = $pdo->query($sql)){
					if($result->rowCount() > 0){

							while($row = $result->fetch()){
								echo '
										<ul>
											<li class="row">
												<div id="article-box">
													<p>'.$row["nom"].'</p>
                                                    <p>'.$row["descri"].'</p>
                                                    <p>'.$row["taille"].'</p>
													<p>'.$row["prix"].'</p>
													<a class="icone_modif" href="article.modif.php?id= '. $row["id"] .'" title="Update Record" data-toggle="tooltip">'.'<i class="fas fa-pencil-alt"></i></a>
													<a class="icone_delete" href="article.delete.php?id= '. $row['id'] .'" title="Delete Record" data-toggle="tooltip">'.'<i class="fas fa-trash"></i></a>
												</div>
											</li>
										</ul>
									';
							}
						// Free result set
						unset($result);
					} else{
						echo "<p'>No records were found.</p>";
					}
				} else{
					echo "ERROR: Was not able to execute $sql. " . $pdo->error;
				}
				
				// Close connection
				unset($pdo);
			?>
			
			<div id="modif-pass">
				<a href="article.add.php">Ajouter un article</a>
			</div>

		</div>

	</div>

</main>

</body>

<script src="assets/js/menu.js"></script>

</html>
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
	<link rel="stylesheet" type="text/css" href="assets/css/account.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>
    
<?php include 'includes/header.php';?>
<?php include 'includes/account.inc.php';?>

<main>
	
	<div id="container">

		<h1 id="title">Account</h1>

		<div id="account-box">

			<?php echo $email; ?>

			<div id="adresses">

						<?php			
							
							// Attempt select query execution
							$sql = "SELECT * FROM coordonnees WHERE userid = :id";
							
							if($stmt = $pdo->prepare($sql)){
								// Set parameters
								$param_id = trim($_SESSION["id"]);
						
								// Bind variables to the prepared statement as parameters
								$stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
								
								// Attempt to execute the prepared statement
								if($stmt->execute()){

										if($stmt->rowCount() > 0){

											while($row = $stmt->fetch()){

												echo '

														<li class="adresse-client">
															<input class="hiddenvalue" name="idphoto" type="hidden" value='.$row['id'].' />
															
															<p>'. $row["nom"] .'</p>
															<p>'. $row["prenom"] .'</p>
															<p>'. $row["adresse"] .'</p>
															<p>'. $row["zipcode"] .'</p>
															<p>'. $row["ville"] .'</p>
															<p>'. $row["pays"] .'</p>

															<a class="icone_modif" href="modif.info.php?id= '. $row["id"] .'" title="Update Record" data-toggle="tooltip">'.'<i class="fas fa-pencil-alt"></i></a>
															<a class="icone_delete" href="includes/info.delete.inc.php?id= '. $row['id'] .'" title="Delete Record" data-toggle="tooltip">'.'<i class="fas fa-trash"></i></a>
															
														</li>

													';
											}
										// Free result set
										unset($result);
										} else{
											echo "<p'>No records were found.</p>";
										}
								}
					
							}
							// Close connection
							unset($pdo);
						?>

			</div>

			<div id="info">

				<button id="btn-modif-info">Ajouter une adresse de livraison</button>

				<form id="info-form" action="includes/info.add.inc.php" method="post">

					<div class="form-signup">
						<input class="form-input" type="text" name="nom" placeholder=" Nom">
					</div>
					<div class="form-signup">
						<input class="form-input" type="text" name="prenom" placeholder=" Prénom">
					</div>
					<div class="form-signup">
						<input class="form-input" type="text" name="adresse" placeholder=" Adresse (numéro et rue)">
					</div>
					<div class="form-signup">
						<input class="form-input" type="text" name="zipcode" placeholder=" Code Postal">
					</div>
					<div class="form-signup">
						<input class="form-input" type="text" name="ville" placeholder=" Ville">
					</div>
					<div class="form-signup">
						<input class="form-input" type="text" name="pays" placeholder=" Pays">
					</div>
					<div>
						<button type="submit" name="submit-info">Enregistrer</button>
					</div>
					<div>
						<button id="btn-close-info">Fermer</button>
					</div>

				</form>
				
			</div>


			<div id="modif-pass">
				<a href="includes/modif.pass.inc.php">Modifier mon mot de passe</a>
			</div>

			<div id="modif-pass">
				<!-- <button id="btn-delete-account">Supprimer mon compte</button> -->
				<a href="includes/account.delete.inc.php">Supprimer le compte</a>
			</div>



		</div>

	</div>

</main>


</body>

<script src="assets/js/menu.js"></script>

</html>
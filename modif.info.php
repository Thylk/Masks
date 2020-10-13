<?php

// Include config file
require_once "includes/dbh.inc.php";
 
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){

        // Get hidden input value
        $id = $_POST["id"];

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $zipcode = $_POST["zipcode"];
        $ville = $_POST["ville"];
        $pays = $_POST["pays"];


        // Prepare an update statement
        $sql = "UPDATE coordonnees SET nom=:nom, prenom=:prenom, adresse=:adresse, zipcode=:zipcode, ville=:ville, pays=:pays WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":prenom", $param_prenom);
            $stmt->bindParam(":adresse", $param_adresse);
            $stmt->bindParam(":zipcode", $param_zipcode);
            $stmt->bindParam(":ville", $param_ville);
            $stmt->bindParam(":pays", $param_pays);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_adresse = $adresse;
            $param_zipcode = $zipcode;
            $param_ville = $ville;
            $param_pays = $pays;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: account.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM coordonnees WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $nom = $row['nom'];
                    $prenom = $row["prenom"];
                    $adresse = $row["adresse"];
                    $zipcode = $row["zipcode"];
                    $ville = $row["ville"];
                    $pays = $row["pays"];

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        // header("location: error.php");
        // exit();
    }
}
?>

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
	<link rel="stylesheet" type="text/css" href="assets/css/modif.info.css">
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

		<h1 id="title">Modifier ces coordoonées</h1>

		<div id="info-box">


            <form id="info-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="form-signup">
                    <input class="form-input" type="text" name="nom" placeholder=" Nom" value="<?php echo $nom; ?>">
                </div>
                <div class="form-signup">
                    <input class="form-input" type="text" name="prenom" placeholder=" Prénom" value="<?php echo $prenom; ?>">
                </div>
                <div class="form-signup">
                    <input class="form-input" type="text" name="adresse" placeholder=" Adresse (numéro et rue)" value="<?php echo $adresse; ?>">
                </div>
                <div class="form-signup">
                    <input class="form-input" type="text" name="zipcode" placeholder=" Code Postal" value="<?php echo $zipcode; ?>">
                </div>
                <div class="form-signup">
                    <input class="form-input" type="text" name="ville" placeholder=" Ville" value="<?php echo $ville; ?>">
                </div>
                <div class="form-signup">
                    <input class="form-input" type="text" name="pays" placeholder=" Pays" value="<?php echo $pays; ?>">
                </div>
                <div>
                    <button type="submit" name="submit-info">Enregistrer</button>
                </div>
                <div>
                    <button id="btn-close-info">Fermer</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>

            </form>


		</div>

	</div>

</main>


</body>

<script src="assets/js/menu.js"></script>

</html>
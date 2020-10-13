


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
	<link rel="stylesheet" type="text/css" href="assets/css/cart.css">
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

		<h1 id="title">Panier</h1>

		<div id="cart-box">
			
            <?php

                if(isset($_SESSION["id"]) && !empty(trim($_SESSION["id"]))){
                    // Include config file
                    require "includes/dbh.inc.php";
                    
                    // Prepare a select statement
                    $sql = "SELECT * FROM paniers WHERE clientid = :clientid";
                    if($stmt = $pdo->prepare($sql)){
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":clientid", $param_id);
                        
                        // Set parameters
                        $param_id = $_SESSION['id'];
                        
                        // Attempt to execute the prepared statement
                        if($stmt->execute()){
                            if($stmt->rowCount() > 0){

                                $total_array = array();
                                while($row = $stmt->fetch()){

                                    $subtotal = $row["quantite"]*$row["prix"];
                                    array_push($total_array, $subtotal);
                                    // $total_array[$subtotal];

                                    echo '

                                            <li class="row-panier-client">
                                                
                                                <p>'. $row["nom"] .'</p>
                                                <p>'. $row["prix"] .'</p>
                                                <p>'. $row["taille"] .'</p>
                                                <p>'. $row["quantite"] .'</p>
                                                <p>'. $row["quantite"]*$row["prix"] .'</p>

                                                <a class="icone_modif" href="modif.info.php?id= '. $row["id"] .'" title="Update Record" data-toggle="tooltip">'.'<i class="fas fa-pencil-alt"></i></a>
                                                <a class="icone_delete" href="includes/info.delete.inc.php?id= '. $row['id'] .'" title="Delete Record" data-toggle="tooltip">'.'<i class="fas fa-trash"></i></a>
                                                
                                            </li>

                                        ';

                                }
                                $total = array_sum($total_array);
                                echo "$total";

                            } else{
                                echo('Votre panier est vide');
                                // URL doesn't contain valid id. Redirect to error page
                                // header("location: error.php");
                                // exit();
                            }
                            
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
                    
                        // Close statement
                        unset($stmt);
                        

                } else{
                    // URL doesn't contain id parameter. Redirect to error page
                    // header("location: error.php");
                    // exit();
                }

            ?>

            <form method="POST" action="includes/commande.inc.php">
                <button name="btn-valider">Valider ma commande</button>
            </form>

		</div>

	</div>

</main>

</body>

<script src="assets/js/menu.js"></script>

</html>
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
	<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
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

		<h1 id="title">Command Handling</h1>

		<div id="admin-box">
			
            <?php 

            // Include config file
            require_once "includes/dbh.inc.php";

                if(isset($_GET["id"])){

                    $orderid = $_GET["id"];
                    // echo($orderid);


                    // Prepare a select statement
                    $sql = "SELECT * FROM commandes WHERE id = :orderid";
                    if($stmt = $pdo->prepare($sql)){
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":orderid", $param_orderid);
                        
                        // Set parameters
                        $param_orderid = $orderid;
                        
                        // Attempt to execute the prepared statement
                        if($stmt->execute()){
                            if($stmt->rowCount() == 1){
                                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                                // Retrieve individual field value
                                $clientid = $row['clientid'];
                                $montant = $row["montant"];
                                $date = $row["le"];

                                // echo($clientid.$montant.$date);

                            } else{
                                // URL doesn't contain valid id. Redirect to error page
                                header("location: error.php");
                                exit();
                            }
                            
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }

                    // Attempt select query execution
                    $sql = "SELECT * FROM commandes_products WHERE orderid = :orderid";

                    if($stmt = $pdo->prepare($sql)) {

                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":orderid", $param_orderid, PDO::PARAM_INT);

                        $param_orderid = $orderid;

                        // Attempt to execute the prepared statement
                        if($stmt->execute()){

                            if($stmt->rowCount() > 0){

                                while($row = $stmt->fetch()){

                                    $articleid = $row["articleid"];
                                    $quantity = $row["quantity"];

                                    echo("Id de l'article: ".$articleid);
                                    echo("Quantité: ".$quantity);

                                }

                            }

                        }

                    }

                    $sql = "SELECT * FROM coordonnees WHERE userid = :clientid";

                    if($stmt = $pdo->prepare($sql)) {

                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":clientid", $param_clientid, PDO::PARAM_INT);

                        $param_clientid = $clientid;

                        // Attempt to execute the prepared statement
                        if($stmt->execute()){

                            if($stmt->rowCount() > 0){

                                while($row = $stmt->fetch()){

                                    $nom = $row["nom"];
                                    $prenom = $row["prenom"];
                                    $adresse = $row["adresse"];
                                    $zipcode = $row["zipcode"];
                                    $ville = $row["ville"];
                                    $pays = $row["pays"];

                                    echo($nom.$prenom.$adresse.$zipcode.$ville.$pays);

                                }

                            }

                        }

                    }

                }
            
                echo(

                    
                    '<form method="POST" action="update.command.php">
                        <input type="hidden" name="orderid" value="'.$orderid.'">
                        <button type="submit" name="btn-update-command">Expediée</button>
                    </form>'
                    
                );
                
            ?>

            
            

		</div>

	</div>

</main>

</body>

<script src="assets/js/menu.js"></script>

</html>
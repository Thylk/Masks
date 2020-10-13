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

		<h1 id="title">Commandes</h1>

		<div id="admin-box">
			
			<div id="commandes-box">


                <?php
                    // Include config file
                    require_once "includes/dbh.inc.php";

                    // SNAPSHOT BDD COMMANDES
                    $array_commandes = array();
                    // Attempt select query execution
                    $sql = "SELECT * FROM commandes";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            
                            
                                while($row = $result->fetch()){

                                    $array_commandes_row = array();
                                    $orderid = $row["id"];
                                    $clientid = $row["clientid"];
                                    $montant = $row["montant"];
                                    $date = $row["le"];
                                    
                                    array_push($array_commandes_row, $orderid, $clientid, $montant, $date);
                                    array_push($array_commandes, $array_commandes_row);
                                }
                                // var_dump($array_commandes);
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p'>No records were found.</p>";
                        }
                    } else{
                        echo "ERROR: Was not able to execute $sql. " . $pdo->error;
                    }
                    
                    // Close connection
                    // unset($pdo);


                    // SNAPSHOT BDD COMMANDES_PRODUCT
                    $array_commandes_product = array();
                    // Attempt select query execution
                    $sql = "SELECT * FROM commandes_products";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            
                            
                                while($row = $result->fetch()){
                                    
                                    $array_commandes_product_row = array();
                                    $orderid = $row["orderid"];
                                    $articleid = $row["articleid"];
                                    $quantity = $row["quantity"];
                                    
                                    array_push($array_commandes_product_row, $orderid, $articleid, $quantity);
                                    array_push($array_commandes_product, $array_commandes_product_row);
                                }
                                // var_dump($array_commandes_product);
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p'>No records were found.</p>";
                        }
                    } else{
                        echo "ERROR: Was not able to execute $sql. " . $pdo->error;
                    }



                    // SNAPSHOT BDD COORDONNEES
                    $array_coordonnees = array();
                    // Attempt select query execution
                    $sql = "SELECT * FROM coordonnees";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            
                            
                                while($row = $result->fetch()){
                                    
                                    $array_coordonnees_row = array();
                                    $nom = $row["nom"];
                                    $prenom = $row["prenom"];
                                    $adresse = $row["adresse"];
                                    $zipcode = $row["zipcode"];
                                    $ville = $row["ville"];
                                    $pays = $row["pays"];
                                    $userid = $row["userid"];
                                    
                                    array_push($array_coordonnees_row, $nom, $prenom, $adresse, $zipcode, $ville, $pays, $userid);
                                    array_push($array_coordonnees, $array_coordonnees_row);
                                }
                                // var_dump($array_coordonnees);
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

                    

                    for($i = 0; $i < count($array_commandes); $i++) {

                        $orderid = $array_commandes[$i][0];
                        $clientid = $array_commandes[$i][1];
                        $montant = $array_commandes[$i][2];
                        $date = $array_commandes[$i][3];
                        
                        echo($orderid.$clientid.$montant.$date);

                        $coord_user_index = array_search($clientid, array_column($array_coordonnees, 6));
                        // echo($coord_user);
                        // var_dump($coord_user_index);

                        $nom = $array_coordonnees[$coord_user_index][0];
                        $prenom = $array_coordonnees[$coord_user_index][1];
                        $adresse = $array_coordonnees[$coord_user_index][2];
                        $zipcode = $array_coordonnees[$coord_user_index][3];
                        $ville = $array_coordonnees[$coord_user_index][4];
                        $pays = $array_coordonnees[$coord_user_index][5];

                        echo($nom.$prenom.$adresse.$zipcode.$ville.$pays);



                        // TEST
                        $article_index = array_search($orderid, array_column($array_commandes_product, 0));

                        for($p = 0; $p < count($array_commandes_product); $p++) {

                            if($array_commandes_product[$p][0] === $orderid){
                                // echo('ok');
                                // var_dump($array_coordonnees[$i][6]);
                                $articleid = $array_commandes_product[$p][1];
                                $quantity = $array_commandes_product[$p][2];

                                echo($articleid.$quantity);
                            }

                        }

                        
                        // FINTEST

                        echo('
                        
                            <a class="icone_modif" href="command.handle.php?id= '. $orderid .'" title="Update Record" data-toggle="tooltip">'.'<i class="fas fa-pencil-alt"></i></a>
                        
                        ');




                        // var_dump($array_coordonnees[$coord_user_index]);

                        
                        

                        // foreach ($array_coordonnees as $val) {
                        //     if ($val[6] === $clientid) {
                        //         var_dump($val);
                        //     }
                        // }
                    }


                ?>


			</div>

		</div>

	</div>

</main>

</body>

<script src="assets/js/menu.js"></script>

</html>
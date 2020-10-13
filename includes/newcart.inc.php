<?php

    // Include config file
    require_once "dbh.inc.php";

    if (isset($_SESSION['id'])) {
        
        // Check if Add to cart has been submitted
        if(filter_input(INPUT_POST, 'add-to-cart')){




            // Verifier si panier existe
            // Prepare an insert statement
            $sql = "SELECT * FROM paniers WHERE clientid=:clientid AND articleid=:articleid";

            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":clientid", $param_clientid, PDO::PARAM_STR);
                $stmt->bindParam(":articleid", $param_articleid, PDO::PARAM_STR);
                
                // Set parameters
                $param_clientid = $_SESSION['id'];
                $param_articleid = $_POST['articleid'];
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    echo 'ok';
                }
            }






                // $clientid = $_SESSION['id'];
                // $articleid = $_POST['articleid'];
                // $nom = $_POST['nom'];
                // $prix = $_POST['prix'];
                // $taille = $_POST['taille'];
                // $quantite = $_POST['quantity'];
    
                // // Prepare an insert statement
                // $sql = "INSERT INTO paniers (clientid, articleid, nom, prix, taille, quantite) VALUES (:clientid, :articleid, :nom, :prix, :taille, :quantite)";
                
                // if($stmt = $pdo->prepare($sql)){
                //     // Bind variables to the prepared statement as parameters
                //     $stmt->bindParam(":clientid", $param_clientid, PDO::PARAM_STR);
                //     $stmt->bindParam(":articleid", $param_articleid, PDO::PARAM_STR);
                //     $stmt->bindParam(":nom", $param_nom, PDO::PARAM_STR);
                //     $stmt->bindParam(":prix", $param_prix, PDO::PARAM_STR);
                //     $stmt->bindParam(":taille", $param_taille, PDO::PARAM_STR);
                //     $stmt->bindParam(":quantite", $param_quantite, PDO::PARAM_STR);
                    
                //     // Set parameters
                //     $param_clientid = $clientid;
                //     $param_articleid = $articleid;
                //     $param_nom = $nom;
                //     $param_prix = $prix;
                //     $param_taille = $taille;
                //     $param_quantite = $quantite;
                    
                //     // Attempt to execute the prepared statement
                //     if($stmt->execute()){
                //         // Redirect to login page
                //         header("Location: shop.php");
                //         exit();
                //     } else{
                //         header("Location: ../shop.php?signup=fail");
                //         exit();
                //     }
                // }
                
                // // Close statement
                // unset($stmt);
    
                // // Close connection
                // unset($pdo);



                // // Redirect to login page
                // header("Location: ../shop.php?add=success");
                // exit();

            
            
        }

    }
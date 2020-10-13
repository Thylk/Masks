<?php

session_start();

// Include config file
require_once "dbh.inc.php";
 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // IMAGE 1
    $img = $_FILES['img'];
    // print_r($file);
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];
    $imgError = $_FILES['img']['error'];
    $imgType = $_FILES['img']['type'];

    $upload_dir = '../assets/img/img_articles/';
    $imgExt = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
    $valid_extensions = array('jpg', 'jpeg', 'png');
    $picProfile = rand(1000, 1000000).'.'.$imgExt;
    move_uploaded_file($imgTmpName, $upload_dir.$picProfile);


    $nom = trim($_POST["nom"]);
    $descri = trim($_POST["descri"]);
    $taille = trim($_POST["taille"]);
    $prix = trim($_POST["prix"]);


        // Prepare an insert statement
        $sql = "INSERT INTO articles (img, nom, descri, taille, prix) VALUES (:img, :nom, :descri, :taille, :prix)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":descri", $param_descri);
            $stmt->bindParam(":taille", $param_taille);
            $stmt->bindParam(":prix", $param_prix);
            
            
            // Set parameters
            $param_img = $picProfile;
            $param_nom = $nom;
            $param_descri = $descri;
            $param_taille = $taille;
            $param_prix = $prix;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                

                // Records created successfully. Redirect to landing page
                header("location: ../gestionnaire.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    
    
    // Close connection
    unset($pdo);
}
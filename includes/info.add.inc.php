<?php 
   session_start();

if (isset($_POST['submit-info'])) {

require 'dbh.inc.php';


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$zipcode = $_POST['zipcode'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$userid = $_SESSION['id'];

if (empty($nom) || empty($prenom) || empty($adresse) || empty($zipcode) || empty($ville) || empty($pays) || empty($userid)) {
    header("Location: ../register.php?error=emptyfields&mail=".$email);
    exit();
} 
else {

        // Prepare an insert statement
        $sql = "INSERT INTO coordonnees (nom, prenom, adresse, zipcode, ville, pays, userid) VALUES (:nom, :prenom, :adresse, :zipcode, :ville, :pays, :userid)";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nom", $param_nom, PDO::PARAM_STR);
            $stmt->bindParam(":prenom", $param_prenom, PDO::PARAM_STR);
            $stmt->bindParam(":adresse", $param_adresse, PDO::PARAM_STR);
            $stmt->bindParam(":zipcode", $param_zipcode, PDO::PARAM_STR);
            $stmt->bindParam(":ville", $param_ville, PDO::PARAM_STR);
            $stmt->bindParam(":pays", $param_pays, PDO::PARAM_STR);
            $stmt->bindParam(":userid", $param_userid, PDO::PARAM_STR);
            
            // Set parameters
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_adresse = $adresse;
            $param_zipcode = $zipcode;
            $param_ville = $ville;
            $param_pays = $pays;
            $param_userid = $userid;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("Location: ../account.php?signup=success");
                exit();
            } else{
                header("Location: ../account.php?signup=fail");
                exit();
            }
        }
        
        // Close statement
        unset($stmt);

}


// Close connection
unset($pdo);

}
else {
header("Location: ../account.php");
exit();
}
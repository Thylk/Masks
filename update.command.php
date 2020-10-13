<?php 
require_once "includes/dbh.inc.php";

if (isset($_POST["btn-update-command"])) {

    $orderid = $_POST['orderid'];

    // Prepare a delete statement
    $sql = "UPDATE commandes SET statut = :statut WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
        $stmt->bindParam(":statut", $param_statut, PDO::PARAM_STR);
        
        // Set parameters
        $param_id = $_POST["orderid"];
        $param_statut = "Expediée";
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){

            // Records deleted successfully. Redirect to landing page
            header("Location: command.handle.php?update=success");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else {
    echo('error');
}
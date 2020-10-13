<?php

if(isset($_SESSION["id"]) && !empty(trim($_SESSION["id"]))){
    // Include config file
    require "includes/dbh.inc.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM user WHERE id = :id";
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = $_SESSION['id'];
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                // Retrieve individual field value
                $email = $row['mail'];


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
        

} else{
    // URL doesn't contain id parameter. Redirect to error page
    // header("location: error.php");
    // exit();
}

<?php

if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    $email = $_POST['mail'];
    $password = $_POST['pwd'];

    if (empty($email) || empty ($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {

        // Prepare a select statement
        $sql = "SELECT id, mail, pass FROM user WHERE mail = :mail";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mail", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["mail"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if email exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $email = $row["mail"];
                        $hashed_pass = $row["pass"];
                        if(password_verify($password, $hashed_pass)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["mail"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: ../account.php");
                        } else{
                            // Display an error message if password is not valid
                            $pass_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);

    }

}
else {
    header("Location: ../index.php");
    exit();
}
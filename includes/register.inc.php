<?php

if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../register.php?error=emptyfields&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail");
        exit();
    }
    else if ($password !== $passwordRepeat) {
        header("Location: ../register.php?error=passwordcheck&mail=".$email);
        exit();
    }
    else {

        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE mail = :mail";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mail", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["mail"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

                if($stmt->rowCount() > 0){

                    header("Location: ../register.php?error=emailalreadyinuse?mail=".$email);
                    exit();

                } else{

                    // Prepare an insert statement
                    $sql = "INSERT INTO user (mail, pass) VALUES (:mail, :pass)";
                    
                    if($stmt = $pdo->prepare($sql)){
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":mail", $param_email, PDO::PARAM_STR);
                        $stmt->bindParam(":pass", $param_pass, PDO::PARAM_STR);
                        
                        // Set parameters
                        $param_email = $email;
                        $param_pass = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash
                        
                        // Attempt to execute the prepared statement
                        if($stmt->execute()){
                            // Redirect to login page
                            header("Location: ../register.php?signup=success");
                            exit();
                        } else{
                            header("Location: ../register.php?signup=fail");
                            exit();
                        }
                    }
                    
                    // Close statement
                    unset($stmt);

                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);

    }

    // Close connection
    unset($pdo);

}
else {
    header("Location: ../register.php");
    exit();
}
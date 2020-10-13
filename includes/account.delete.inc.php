<?php

// Initialize the session
session_start();

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require "dbh.inc.php";
    

    // Prepare a delete statement
    $sql = "SELECT * FROM coordonnees WHERE userid = :id";

    if($stmt = $pdo->prepare($sql)){
        // Set parameters
        $param_id = trim($_SESSION["id"]);

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){

                if($stmt->rowCount() > 0){

                    // Prepare a delete statement
                    $sql = "DELETE FROM coordonnees WHERE userid = :id";
        
                    if($stmt = $pdo->prepare($sql)){
                        // Set parameters
                        $param_id = trim($_SESSION["id"]);
        
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
                        
                        // Attempt to execute the prepared statement
                        if($stmt->execute()){
                            
                            // Prepare a delete statement
                            $sql = "DELETE FROM user WHERE id=:id";
        
                            if($stmt = $pdo->prepare($sql)){
                                // Set parameters
                                $param_id = trim($_SESSION["id"]);
        
                                // Bind variables to the prepared statement as parameters
                                $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
                                
                                // Attempt to execute the prepared statement
                                if($stmt->execute()){
                                    session_unset();
                                    session_destroy();
                                    header("location: ../register.php");
                                } else{
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                            }
                        // Close statement
                        unset($stmt);
                        
                        // Close connection
                        unset($pdo);
                        
        
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
                // Close statement
                unset($stmt);
                
                // Close connection
                unset($pdo);
        
                }
            else {

                // Prepare a delete statement
                $sql = "DELETE FROM user WHERE id=:id";

                if($stmt = $pdo->prepare($sql)){
                    // Set parameters
                    $param_id = trim($_SESSION["id"]);

                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        session_unset();
                        session_destroy();
                        header("location: ../register.php");
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                // Close statement
                unset($stmt);

                // Close connection
                unset($pdo);

            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);


} else{
    // Check existence of id parameter
    if(empty(trim($_SESSION["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
	
<head>
	<META NAME="Author" CONTENT="Maxime Regnault">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Masks</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/account.delete.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>

<main>

<?php include 'header.php';?>
    
    <div id="container">

        <h1 id="title">Supprimer mon compte</h1>

        <div id="delete-box">

            <form id="delete-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <input type="hidden" name="id" value="<?php echo trim($_SESSION["id"]); ?>"/>
                    <h4>Êtes-vous sûr de vouloir supprimer votre compte?</h4>
                    <div>
                        <input type="submit" class="btn btn-primary" value="Yes">
                        <a href="../account.php" class="btn">No</a>
                    </div>
                </div>
            </form>

        </div>
        

    </div>

</main>

</body>

</html>
<?php

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "includes/dbh.inc.php";

    // TEST 
    // Get URL parameter
    $id =  trim($_POST["id"]);
        
    // Prepare a select statement
    $sql = "SELECT * FROM articles WHERE id = :id";
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = $id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                // Retrieve individual field value
                $imgFile = $row['img'];

                unlink("assets/img/img_articles/$imgFile");

            } else{
                // URL doesn't contain valid id. Redirect to error page
                echo "No id 3";
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // FIN TEST

    // Prepare a delete statement
    $sql = "DELETE FROM articles WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){

            // Records deleted successfully. Redirect to landing page
            header("Location: gestionnaire.php");
            exit();
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
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        echo "No id 2";
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
	<title>Atelier à façon</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="assets/css/article.delete.css">
	<!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>
<main>
<?php include 'includes/header.php';?>

    <div id="container">
    
        <h1 id="title">Effacer l'article</h1>
        <div id="article-delete-box">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                    <h4>Êtes-vous sûr de vouloir supprimer cet article?</h4>
                    <div>
                        <input type="submit" class="btn btn-primary" value="Yes">
                        <a href="gestionnaire.php" class="btn">No</a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    

</main>
</body>
</html>
<?php

	// session_start();

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "includes/dbh.inc.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM articles WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $nom = $row["nom"];
                $prix = $row["prix"];
                $descri = $row["descri"];
                $taille = $row["taille"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
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
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
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
	<link rel="stylesheet" type="text/css" href="assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="assets/css/show.article.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>

<?php include 'includes/header.php';?>

<main>

<div id="container">

        <h1 id="title">Article</h1>

        <div id="article-box">
            <h2 id="article_title"><?php echo $row["nom"]; ?></h2>
            <div id="img_article_solo">

            </div>
            <div class="info_article">
                <p class="form-control-static"><?php echo $row["descri"]; ?></p>
            </div>
            <div class="info_article">
                <p class="form-control-static">Taille: <?php echo $row["taille"]; ?></p>
            </div>
            <div class="info_article">
                <p class="form-control-static">Prix: <?php echo $row["prix"]; ?></p>
            </div>
            <a href="shop.php" class="btn btn-primary">Retour</a>
        </div>

</div>
    

</main>
</body>
</html>
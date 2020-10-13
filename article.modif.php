<?php
    
// Include config file
require_once "includes/dbh.inc.php";
 
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // EFFACER LES ANCIENNES PHOTOS

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
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

    // 


    // IMAGE 1
    $img = $_FILES['img'];
    // print_r($file);
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];
    $imgError = $_FILES['img']['error'];
    $imgType = $_FILES['img']['type'];

    $upload_dir = 'assets/img/img_articles/';
    $imgExt = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
    $valid_extensions = array('jpg', 'jpeg', 'png');
    $picProfile = rand(1000, 1000000).'.'.$imgExt;
    move_uploaded_file($imgTmpName, $upload_dir.$picProfile);

    $nom = $_POST["nom"];
    $descri = $_POST["descri"];
    $taille = $_POST["taille"];
    $prix = $_POST["prix"];
    
        // Prepare an update statement
        $sql = "UPDATE articles SET img=:img, nom=:nom, descri=:descri, taille=:taille, prix=:prix WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":descri", $param_descri);
            $stmt->bindParam(":taille", $param_taille);
            $stmt->bindParam(":prix", $param_prix);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_img = $picProfile;
            $param_nom = $nom;
            $param_descri = $descri;
            $param_taille = $taille;
            $param_prix = $prix;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: gestionnaire.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    
    
    // Close connection
    unset($pdo);
} else{

    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
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
                    $id = $row['id'];
                    $imgFile = $row['img'];
                    $nom = $row["nom"];
                    $descri = $row["descri"];
                    $taille = $row["taille"];
                    $prix = $row["prix"];

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
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        // header("location: error.php");
        // exit();
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
	<link rel="stylesheet" type="text/css" href="assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="assets/css/article.modif.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>
    
<?php include 'includes/header.php';?>

<main>
	
	<div id="container">

		<h1 id="title">Modifier un article</h1>

		<div id="modif-article-box">
            
                <img src="assets/img/img_articles/<?php echo $imgFile; ?>" width="200px" />
                <form enctype="multipart/form-data" action="article.modif.php" method="post">
                        
                        <div class="form-signup">
                            <input type="file" name="img">
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="nom" placeholder=" Nom" value="<?php echo $nom; ?>">
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="descri" placeholder=" Description" value="<?php echo $descri; ?>"></input>
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="taille" placeholder=" Taille" value="<?php echo $taille; ?>"></input>
                        </div>
                        <div class="form-signup">
                            <input class="form-input" type="text" name="prix" placeholder=" Prix" value="<?php echo $prix; ?>"></input>
                        </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <button type="submit" name="signup-submit">Ajouter article</button>
                </form>
                <button id="close-add">Fermer</button>

		</div>

	</div>

</main>

</body>

<script src="assets/js/menu.js"></script>

</html>
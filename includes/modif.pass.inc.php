<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "dbh.inc.php";
 
// Define variables and initialize with empty values
$new_pass = $confirm_pass = "";
$new_pass_err = $confirm_pass_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_pass"]))){
        $new_pass_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_pass"])) < 6){
        $new_pass_err = "Password must have atleast 6 characters.";
    } else{
        $new_pass = trim($_POST["new_pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_pass"]))){
        $confirm_pass_err = "Please confirm the password.";
    } else{
        $confirm_pass = trim($_POST["confirm_pass"]);
        if(empty($new_pass_err) && ($new_pass != $confirm_pass)){
            $confirm_pass_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_pass_err) && empty($confirm_pass_err)){
        // Prepare an update statement
        $sql = "UPDATE user SET pass = :pass WHERE id = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":pass", $param_pass, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
            // Set parameters
            $param_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../login.php");
                exit();
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
	<link rel="stylesheet" type="text/css" href="../assets/css/modif.pass.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>

<?php include 'header.php';?>

<main>

    <div id="container">

        <h1 id="title">Change Password</h1>

        <div id="modif-pass-box">

            <p>Please fill out this form to modify your password.</p>

            <form id="modif-pass-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group <?php echo (!empty($new_pass_err)) ? 'has-error' : ''; ?>">
                    <label>New Password</label>
                    <input type="password" name="new_pass" class="form-control" value="<?php echo $new_pass; ?>">
                    <span class="help-block"><?php echo $new_pass_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_pass_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_pass" class="form-control">
                    <span class="help-block"><?php echo $confirm_pass_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a class="btn btn-link" href="account.php">Cancel</a>
                </div>
            </form>

        </div>
        

    </div>

</main>

</body>
</html>
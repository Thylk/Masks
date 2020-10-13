<?php
    // session_start();
    $product_ids = array();
    // session_destroy();
    // Include config file
    require_once "dbh.inc.php";

    if (isset($_SESSION['id'])) {
        
        // Check if Add to cart has been submitted
        if(filter_input(INPUT_POST, 'add-to-cart')){



            // Verifier si panier existe
            // Prepare an insert statement
            $sql = "SELECT * FROM paniers WHERE clientid=:clientid AND articleid=:articleid";

            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":clientid", $param_clientid, PDO::PARAM_STR);
                $stmt->bindParam(":articleid", $param_articleid, PDO::PARAM_STR);
                
                // Set parameters
                $param_clientid = $_SESSION['id'];
                $param_articleid = $_POST['articleid'];
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){

                    // IF NO PANIER CREATE ONE
                    if($stmt->rowCount() == 0){

                        $clientid = $_SESSION['id'];
                        $articleid = $_POST['articleid'];
                        $nom = $_POST['nom'];
                        $prix = $_POST['prix'];
                        $taille = $_POST['taille'];
                        $quantite = $_POST['quantity'];
            
                        // Prepare an insert statement
                        $sql = "INSERT INTO paniers (clientid, articleid, nom, prix, taille, quantite) VALUES (:clientid, :articleid, :nom, :prix, :taille, :quantite)";
                        
                        if($stmt = $pdo->prepare($sql)){
                            // Bind variables to the prepared statement as parameters
                            $stmt->bindParam(":clientid", $param_clientid, PDO::PARAM_STR);
                            $stmt->bindParam(":articleid", $param_articleid, PDO::PARAM_STR);
                            $stmt->bindParam(":nom", $param_nom, PDO::PARAM_STR);
                            $stmt->bindParam(":prix", $param_prix, PDO::PARAM_STR);
                            $stmt->bindParam(":taille", $param_taille, PDO::PARAM_STR);
                            $stmt->bindParam(":quantite", $param_quantite, PDO::PARAM_STR);
                            
                            // Set parameters
                            $param_clientid = $clientid;
                            $param_articleid = $articleid;
                            $param_nom = $nom;
                            $param_prix = $prix;
                            $param_taille = $taille;
                            $param_quantite = $quantite;
                            
                            // Attempt to execute the prepared statement
                            if($stmt->execute()){
                                // Redirect to login page
                                header("Location: shop.php?signup=success");
                                exit();
                            } else{
                                header("Location: shop.php?signup=fail");
                                exit();
                            }
                        }
                        
                        // Close statement
                        unset($stmt);
            
                        // Close connection
                        unset($pdo);

                    } 
                    else {

                        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                        // Retrieve individual field value
                        $quantite = $row['quantite'];
            
                        // echo($quantite);
                        $add = $quantite+1;


                        // Prepare an update statement
                        $sql = "UPDATE paniers SET quantite=:quantite WHERE clientid=:clientid AND articleid=:articleid";

                        if($stmt = $pdo->prepare($sql)){
                            // Bind variables to the prepared statement as parameters
                            $stmt->bindParam(":quantite", $param_quantite);
                            $stmt->bindParam(":clientid", $param_clientid);
                            $stmt->bindParam(":articleid", $param_articleid);
                            
                            // Set parameters
                            $param_quantite = $add;
                            $param_clientid = $_SESSION['id'];
                            $param_articleid = $_POST['articleid'];
                            
                            // Attempt to execute the prepared statement
                            if($stmt->execute()){
                                // Records updated successfully. Redirect to landing page
                                header("location: shop.php?quant=success");
                                exit();
                            } else{
                                echo "Something went wrong. Please try again later.";
                            }
                        }
                    }
                    
                } else{
                    header("Location: shop.php?signup=fail");
                    exit();
                }
            }

            
            
        }

    } else {

        // CLIENT IS NOT LOGGED IN, STORE CART IN $_SESSION
        
        // Check if Add to cart has been submitted
        if(filter_input(INPUT_POST, 'add-to-cart')){
            
            if(isset($_SESSION['shopping_cart'])){

                // Keep track of how many prodcuts are in the shopping cart
                $count = count($_SESSION['shopping_cart']);

                // Create array to match product ids
                $product_ids = array_column($_SESSION['shopping_cart'], 'id');

                // pre_r($product_ids);
                if(!in_array(filter_input(INPUT_POST, 'id'), $product_ids)){
                $_SESSION['shopping_cart'][$count] = array
                    (
                        'id' => filter_input(INPUT_POST, 'id'),
                        'nom' => filter_input(INPUT_POST, 'nom'),
                        'prix' => filter_input(INPUT_POST, 'prix'),
                        'taille' => filter_input(INPUT_POST, 'taille'),
                        'quantity' => filter_input(INPUT_POST, 'quantity')
                    );
                }
                else{
                    for ($i = 0; $i < count($product_ids); $i++){
                        if ($product_ids[$i] == filter_input(INPUT_POST, 'id')){
                            //Add item quantity to existing product in shopping cart
                            $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                        }
                    }
                }

            }
            else{ // If shopping cart dosen't exist, create first product with array key 0
                // create array using sumbitted form data, start from key 0 and fill it with values
                $_SESSION['shopping_cart'][0] = array
                (
                    'id' => filter_input(INPUT_POST, 'id'),
                    'nom' => filter_input(INPUT_POST, 'nom'),
                    'taille' => filter_input(INPUT_POST, 'taille'),
                    'quantity' => filter_input(INPUT_POST, 'quantity'),
                    'prix' => filter_input(INPUT_POST, 'prix')
                );
            }
        }

    }


    

?>
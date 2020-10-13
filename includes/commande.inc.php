<?php

session_start();

if(isset($_POST['btn-valider'])) {

    if(isset($_SESSION["id"]) && !empty(trim($_SESSION["id"]))){
        // Include config file
        require "dbh.inc.php";
        
        // Prepare a select statement
        $sql = "SELECT * FROM paniers WHERE clientid = :clientid";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":clientid", $param_id);
            
            // Set parameters
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() > 0){

                   

                    
                    $testarray = array();
                    $total_array = array();

                    while($row = $stmt->fetch()){

                        $subtotal = $row["quantite"]*$row["prix"];
                        array_push($total_array, $subtotal);

                        $articleid = $row["articleid"];
                        $quantity = $row["quantite"];
                        

                        $array_row_panier = array();
                        array_push($array_row_panier, $articleid, $quantity);
                        array_push($testarray, $array_row_panier);
                    }

                    $total = array_sum($total_array);
                    // echo "$total";
                    $clientid = $_SESSION["id"];


                    $statut = 'En attente de traitement';
                    // Prepare an insert statement
                    $sql = "INSERT INTO commandes (clientid, montant, le, statut) VALUES (:clientid, :montant, :le, :statut)";
                    
                    if($stmt = $pdo->prepare($sql)){
                        // Bind variables to the prepared statement as parameters
                        $stmt->bindParam(":clientid", $param_clientid, PDO::PARAM_STR);
                        $stmt->bindParam(":montant", $param_montant, PDO::PARAM_STR);
                        $stmt->bindParam(":le", $param_date, PDO::PARAM_STR);
                        $stmt->bindParam(":statut", $param_statut, PDO::PARAM_STR);
                        
                        // Set parameters
                        $param_clientid = $clientid;
                        $param_montant = $total;
                        $param_date = date("Y-m-d à H:i");
                        $param_statut = $statut;
                        
                        // Attempt to execute the prepared statement
                        if($stmt->execute()){


                            // GET LAST INSERTED ID
                            $orderid = $pdo->lastInsertId();

                                
                                

                                // $keys = array_keys($testarray);
                                for($i = 0; $i < count($testarray); $i++) {
                                    // var_dump($testarray);
                                    
                                    // foreach($testarray as $value) {

                                        // echo $key . " : " . $value . "<br>";
                                        // $articleid = $value[0];
                                        // $quantity = $value[1];
                                        // $articleid = $key[0];
                                        // $quantity = $key[1];

                                        $articleid = $testarray[$i][0];
                                        $quantity = $testarray[$i][1];


                                        // echo($articleid);
                                        // echo($quantity);

                                        // Prepare an insert statement
                                        $sql = "INSERT INTO commandes_products (orderid, articleid, quantity) VALUES (:orderid, :articleid, :quantity)";
                                        
                                        if($stmt = $pdo->prepare($sql)){
                                            // Bind variables to the prepared statement as parameters
                                            $stmt->bindParam(":orderid", $param_orderid, PDO::PARAM_STR);
                                            $stmt->bindParam(":articleid", $param_articleid, PDO::PARAM_STR);
                                            $stmt->bindParam(":quantity", $param_quantity, PDO::PARAM_STR);
                                            
                                            // Set parameters
                                            $param_orderid = $orderid;
                                            $param_articleid = $articleid;
                                            $param_quantity = $quantity;
                                            
                                            // Attempt to execute the prepared statement
                                            if($stmt->execute()){

                                                // echo($array_row_panier);

                                                // Redirect to login page
                                                // header("Location: ../cart.user.php?command=success");
                                                // exit();
                                            } else{
                                                header("Location: ../account.php?signup=fail");
                                                exit();
                                            }
                                        }
                                        
                                        // Close statement
                                        unset($stmt);

                                    // }
                                    
                                }



                                

                                            // Prepare a delete statement
                                            $sql = "DELETE FROM paniers WHERE clientid = :clientid";
                                                                            
                                            if($stmt = $pdo->prepare($sql)){
                                                // Bind variables to the prepared statement as parameters
                                                $stmt->bindParam(":clientid", $param_id, PDO::PARAM_STR);
                                                
                                                // Set parameters
                                                $param_id = $clientid;
                                                
                                                // Attempt to execute the prepared statement
                                                if($stmt->execute()){

                                                    // Records deleted successfully. Redirect to landing page
                                                    // header("Location: ../account.php");
                                                    // exit();
                                                } else{
                                                    echo "Oops! Something went wrong. Please try again later.";
                                                }
                                            }




                            // Redirect to login page
                            header("Location: ../index.php?command=success");
                            exit();
                        } else{
                            header("Location: ../account.php?signup=fail");
                            exit();
                        }
                    }
                    
                    // Close statement
                    unset($stmt);

                    

                } 
                else {
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

}
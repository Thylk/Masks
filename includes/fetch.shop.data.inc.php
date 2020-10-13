<?php

// Include config file
require_once "dbh.inc.php";

if(isset($_POST["action"])){
    
    $query = "
        SELECT * FROM articles
    ";

        if(isset($_POST["taille"]) && isset($_POST["nom"])){
            $brand_filter = implode("','", $_POST["nom"]);
            $taille_filter = implode("','", $_POST["taille"]); // transform value from int to string
            $query .="
            WHERE nom IN('".$brand_filter."') AND taille IN('".$taille_filter."')
            ";
        } 
        else{
            if(isset($_POST["nom"])){
                $brand_filter = implode("','", $_POST["nom"]); // transform value from int to string
                $query .="
                    WHERE nom IN('".$brand_filter."')
                ";
            }
            if(isset($_POST["taille"])){
                $taille_filter = implode("','", $_POST["taille"]); // transform value from int to string
                $query .="
                    WHERE taille IN('".$taille_filter."')
                ";
            }
        }
 

    $output = "";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    if($total_row > 0){
        foreach($result as $row){
            
            // $output = "";

            $output .= '

                    
                    <div class="produit-box">
                        <form method="post" action="">
                            <div class="produit">
                                <div>
                                    <img class="img_article_boutique" src="assets/img/img_articles/'.$row['img'].'"/>
                                </div>
                                <h4 class="text-info">'.$row['nom'].'</h4>
                                <p>'.$row['descri'].'</p>
                                <h4>'.$row['prix'].'</h4>
                                <input type="text" name="quantity" value="1" />
                                <input type="hidden" name="articleid" value="'.$row['id'].'" />
                                <input type="hidden" name="nom" value="'.$row['nom'].'" /> 
                                <input type="hidden" name="prix" value="'.$row['prix'].'" />
                                <input type="hidden" name="taille" value="'.$row['taille'].'" /> 
                                <input type="submit" name="add-to-cart" class="btn btn-info" value="Ajouter au panier" />
                                <a class="btn btn-info" href="show.article.php?id='.$row['id'].'">Voir</a>
                            </div>
                        </form>    
                    </div>
 
                
            ';
        }
    }
    else{
        $output = '<h3>Aucun article ne correspond à votre recherche :(</h3>';
    }
    echo $output;
    
}

?>
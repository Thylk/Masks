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
	<link rel="stylesheet" type="text/css" href="assets/css/shop.css">
	<link rel="stylesheet" type="text/css" href="assets/css/footer.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>
    
<?php include 'includes/header.php';?>
<?php include 'includes/cart.inc.php';?>

<main>
	
	<div id="container">

		<h1 id="title">Boutique</h1>

		<div id="filterbox">

				<div id="modeles">

					<h4>Modèles</h4>
					<?php
						require_once "includes/dbh.inc.php";
						$query = "SELECT DISTINCT (nom) FROM articles ORDER BY id ASC";
						$statement = $pdo->prepare($query);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach($result as $row) 
						{
						?>

						<div class="checkbox">
							<label><input type="checkbox" class="common_selector nom" value="<?php echo $row['nom']; ?>" > <?php echo $row['nom']; ?></label>
						</div>

					<?php
					}    
					?>
					
				</div>

				<div id="tailles">

					<h4>Tailles</h4>
					<?php
						require_once "includes/dbh.inc.php";
						$query = "SELECT DISTINCT (taille) FROM articles ORDER BY id ASC";
						$statement = $pdo->prepare($query);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach($result as $row) 
						{
						?>

						<div class="checkbox">
							<label><input type="checkbox" class="common_selector taille" value="<?php echo $row['taille']; ?>" > <?php echo $row['taille']; ?></label>
						</div>

					<?php
					}    
					?>

				</div>
			
		</div>

		<div id="boxshop" class="row filter-data">

		</div>
		
	</div>

</main>


</body>

<script src="assets/js/menu.js"></script>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data(){
        // $('.filter-data').html; // Can add loader here
        var action = 'fetch-data';
        var nom = get_filter('nom');
        var taille = get_filter('taille');
        $.ajax({
            url:"includes/fetch.shop.data.inc.php",
            method:"POST",
            data:{action:action, nom:nom, taille:taille},
            success:function(data){
                $('.filter-data').html(data); // Output send into the div here
            }
        });
    }

    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        })
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

})
</script>

</html>
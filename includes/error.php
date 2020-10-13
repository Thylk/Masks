<?php 
                    
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
            echo '<p class="error-msg">Veuillez remplir tous les champs</p>';
        } else if ($_GET['error'] == "invalidmail") {
            echo '<p>Adresse email invalide</p>';
        } else if ($_GET['error'] == "passwordcheck") {
            echo '<p>Les passwords ne correspondent pas</p>';
        } else if ($_GET['error'] == "emailalreadyinuse") {
            echo '<p>Cette adresse email est déjà utilisée</p>';
        }
    } else if (isset($_GET['signup'])) {
        if ($_GET['signup'] == "success") {
            echo '<p>Votre compte a bien été créé</p>';
        } else if ($_GET['signup'] == "fail") {
            echo '<p>Erreur lors de la création de compte</p>';
        }
    } else if (isset($_GET['sendmail'])) {
        if ($_GET['sendmail'] == "success") {
            echo '<p id="confirm-mail">Votre mail a bien été envoyé</p>';
        }
    }
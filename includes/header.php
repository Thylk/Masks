<?php 
    session_start();
?>

<header>

    <div id="menu">

        <div id="header-box">
            <?php 
                if (isset($_SESSION['id'])) {
                    echo'
                        <div id="logout-box">
                            <i class="fas fa-check-circle"></i>
                            <p>Connecté</p>
                            <form action="includes/logout.inc.php" method="post">
                                <button type="submit" name="logout-submit">Deconnexion</button>
                            </form>
                        </div>';
                } else {
                    echo'
                        <div id="logout-box">
                            <i class="fas fa-circle"></i>
                            <p>Déconnecté</p>
                        </div>';
                }
            ?>
            <div id="navbar">
                <li><a class="btn-sidebar" href="index.php">Accueil</a></li>
                <li><a class="btn-sidebar" href="shop.php">Boutique</a></li>
                <li><a class="btn-sidebar" href="register.php">Inscription</a></li>
                <li><a class="btn-sidebar" href="login.php">Connexion</a></li>
                <li><a class="btn-sidebar" href="account.php">Compte</a></li>
                <li><a class="btn-sidebar" href="admin.php">Admin</a></li>
                <li><a class="nav-item nav-link" href="<?php if (isset($_SESSION['id'])) {echo('cart.user.php');} else { echo('cart.php'); } ?>"><i class="fas fa-shopping-cart"></i></a></li>
            </div>
            <i id="menu-icon" class="fas fa-bars"></i>
        </div>

        <nav id="nav-sidebar">
            <ul>
                <li><a class="btn-sidebar" href="index.php">Accueil</a></li>
                <li><a class="btn-sidebar" href="shop.php">Boutique</a></li>
                <li><a class="btn-sidebar" href="signin.php">Inscription</a></li>
                <li><a class="btn-sidebar" href="login.php">Connexion</a></li>
                <li><a class="btn-sidebar" href="account.php">Compte</a></li>
                <li><a class="btn-sidebar" href="admin.php">Admin</a></li>
            </ul>
        </nav>

    </div>

</header>
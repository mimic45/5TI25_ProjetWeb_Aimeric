<ul class = "flexible space-between">
    <?php if (isset($_SESSION['user'])) : ?>
        <li class='menu'><a href='mesRecettes'>Mes plats</a></li>
        <li class='menu'><a href='inscription'>Profil</a></li>
        <li class='menu'><a href='deconnexion'>Déconnexion</a></li>
    <?php else : ?>
        <li class='menu'><a href='inscription'>Inscription</a></li>
        <li class='menu'><a href='connexion'>Connexion</a></li>
        <li class="menu"><a href="index">Home</a></li>
    <?php endif ?>
</ul>

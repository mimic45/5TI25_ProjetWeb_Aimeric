<ul class = "flexible space-between">
    <li class="menu"><a href="/">Home</a></li>
    <?php if (isset($_SESSION["user"])) : ?>
        <li class='menu'><a href='mesRecettes'>Mes recettes</a></li>
        <li class='menu'><a href='inscription'>Profil</a></li>
        <li class='menu'><a href='deconnexion'>Déconnexion</a></li>
        <li class='menu'><a href="inscription">Supprimer compte</a></li>
    <?php else : ?>
        <li class='menu'><a href='inscription'>Inscription</a></li>
        <li class='menu'><a href='connexion'>Connexion</a></li>
    <?php endif ?>
</ul>

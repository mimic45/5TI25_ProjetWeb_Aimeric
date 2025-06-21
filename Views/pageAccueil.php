<!-- corps de la page d'accueil qui prendar place dans le main de base.php -->

<!-- !!! corriger le chemin de images ! -->
<?php if ($uri === "/mesRecettes") : ?>
    <h1>Vos recettes</h1>
<?php else : ?>
    <h1>Liste des recettes répertoriées</h1>
<?php endif ?>

<!-- Dans le cas où on est connecté, on affiche un lien permettant l'ajout d une école -->
<?php if (isset($_SESSION["user"])) : ?>
    <a href="../Views/Components/recette/recette.php">Ajouter une recette</a>
    <br><a href="../Views/Components/recette/recette.php">Supprimer une recette</a>
<?php endif ?>

<div class="flexible wrap space-around">
    <?php foreach ($recettes as $recette) : ?>
        <div class="border card">
            <h2 class="center"><?= $recette->recetteNom ?></h2>
            <div>
                <div class="flexible blocImageRecette">
                    <img class="soupe_tomate" src="../../Assets/Images/photo_soupe.jpg" alt="image soupe tomate">
                </div>
                <div class="center">
                    <a href="https://www.marmiton.org/recettes/recette_soupe-tomate-rapide_94528.aspx" class="btn btn-page">Voir la recette</a>
                    <!-- Dans le cas où on est connecté et qu'on a cliqué sur 'mes recettes', on affiche les recettes de l'utilisateur -->
                    <?php if ($uri === "/mesRecettes") : ?>
                        <div class="flexible space-between">
                            <p><a href="deleteRecette?recetteId=<?= $recette->recetteId ?>">Supprimer la recette</a></p>
                            <p><a href="updateRecette?recetteId=<?= $recette->recetteId ?>">Modifier la recette</a></p>
                        </div>
                        
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
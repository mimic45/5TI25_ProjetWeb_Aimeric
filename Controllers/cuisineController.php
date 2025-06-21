<?php

// appel au modèle pour la gestion des recettes
require_once 'Models/cuisineModel.php';

//récupération du chemin désiré
$uri = $_SERVER['REQUEST_URI'];

if($uri === '/mesRecettes') {
    // rappel de la page d'accueil adaptée avec vérification de l'état de connection
    $recettes = selectMyrecette($pdo);

    $title = 'Mes recettes';                // titre à afficher dans l'onglet de la page du navigateur
    $template = ('Views/pageAccueil.php');  // chemin vers la vue demandée
    require_once('View/base.php');          // appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri === '/createRecette') {
    // si on a rempli le formulaire et qu'on l'a validé
    
    if (isset($_POST['btnEnvoi'])) {
        createRecette($pdo);
        //récupération du numéro de la dernière ligne insérée dans la table des recettes
        $recetteId = $pdo->lastInsertId();
        // ajout des ingrédients liées à la recette dans la table des ingrédients
        // ne pas oublier que $_POST["ingredient"] est un tableau ! => le parcourir et faire une écriture pour chaque élément trouvé
        for ($i = 0; $i < count($_POST["ingredients"]); $i++) {
            $ingredientRecetteId = $_POST["ingredients"] [$i];
            // écriture dans la table des ingrédients
            ajouterIngredientRecette($pdo, $recetteId, $ingredientId); 
        }
        header("location:/mesRecettes");
    }
    // récupérer les ingrédients disponibles
    $ingredients = selectAllIngredients($pdo);
    $title = "Ajout d'une recette";                         //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Component/recette/recette.php";      //chemin vers la vue demandée
    require_once("Views/base.php");                         //appel de la page de base qui sera remplie avec la vue demandée
}

elseif (isset($_GET["recetteId"]) && $uri === "/voirRecette?recetteId=" . $_GET["recetteId"]) {
    $recette = selectOneRecette($pdo);
    // ce n'est pas 'selectAllIngredients' mais je ne sais pas quoi mettre d'autre
    $ingredients = selectAllIngredients($pdo);
    $title = "Ajout d'une recette";
    $template = "Views/recette/recette.php";
    require_once("Views/base.php");
}

elseif (isset($_GET["recetteId"]) && $uri === "/updateRecette?recetteId=" . $_GET["recetteId"]) {
    if (isset($_POST['btnEnvoi'])) {
        updateRecette($pdo);
        deleteIngredientRecette($pdo);
        for ($i = 0; $i < count($_POST["ingredients"]); $i++) {
            $ingredientRecetteId = $_POST["ingredients"] [$i];
            ajouterIngredientRecette($pdo, $_GET["recetteId"], $ingredientRecetteId);
        }
        header("location:/mesRecettes");
    }
    $recette = selectOneRecette($pdo);
    $ingredientActifRecette = selectIngredientActifRecette($pdo);
    $ingredients = selectAllIngredients($pdo);
    $title = "Mise à jour d'une recette";
    $template = "Views/recette/recette.php";
    require_once("Views/base.php");
}

elseif (isset($_GET["recetteId"]) && $uri === "/deleteRecette?recetteId=" . $_GET["recetteId"]) {
    deleteIngredientRecette($pdo);
    deleteOneRecette($pdo);
    header("location:/recette");
}



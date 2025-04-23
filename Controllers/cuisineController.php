<?php
require_once 'Models/cuisineModel.php';
$uri = $_SERVER['REQUEST_URI'];
if($uri === '/mesRecettes') {
    $recettes = selectMyrecette($pdo);
    $title = 'Mes recettes';
    $template = ('Views/pageAccueil.php');
    require_once('View/base.php');
}
elseif ($uri === '/createRecette') {
    if (isset($_POST['btnEnvoi'])) {
        createRecette($pdo);
        $recetteId = $pdo->lastInsertId();
        for ($i = 0; $i < count($_POST["options"]); $i++) {
            $optionRecetteId = $_POST["options"] [$i];
        }
        header("location:/mesRecettes");
    }
    $title = "Ajout d'une recette";
    $template = "Views/Component/recette/recette.php";
    require_once("Views/base.php");
}
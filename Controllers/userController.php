<?php   // code php qui décide de ce qu'il faut donner comme valeur à la variable $template

// on ajoutera par la suite les require aux modèles
require_once("Models/userModel.php");
// récupération du chemin désiré
if ($uri === "/connexion") {
    if (isset($_POST['btnEnvoi'])) {
        $erreur = false;
        if (connectUser($pdo)) {
            header('location:/');
        }
        else {
            $erreur = true;
        }
    }
    $title = "Connexion";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/connexion.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri === "/deconnexion") {
    session_destroy();
    header('location:/');
    
}
elseif ($uri ==="/inscription") {
    if (isset($_POST['btnEnvoi'])) {
        createUser($pdo);
        header('location:/connexion');
    }
    $title = "Inscription";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/inscriptionOrEditProfile.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}

elseif ($uri === '/updateProfil') {
    if(isset($_POST['btnEnvoi'])){
        $messageError = verifEmptyData();
        if (!$messageError){
            updateUser($pdo);
            updateSession($pdo);
            header('location:/profile');
        }
    }
    $title = 'Mise à jour du profil';
    $template = "Views/Users/inscriptionOrEditProfile.php"; 
    require_once('Views/base.base');
}

elseif ($uri === "/deleteProfil") {
    deleteHistoriqueRecetteFromUser($pdo);
    deleteAllrecetteFromUser($pdo);
    deleteUser($pdo);
    header('location:/deconnexion');
}

function verifEmptyData()
{
    foreach ($_POST as $key => $value) {
        if (empty(str_replace(' ','', $value))) {
            $messageError[$key] = "Votre " . $key . " est vide.";
        }
    }

    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }
}



<?php 


function selectAllRecettes($pdo)
{
    try {
        //définition de la requête
        $query = 'select * from recette';
        //préparation de l'execution de a requête
        $selectRecette = $pdo->prepare($query);
        //execution
        $selectRecette->execute();
        //récupération des données dans l'objet fetch
        $recettes = $selectRecette->fetchAll();
        //renvoi des données
        return $recettes;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteIngredientRecetteFromUser($dbh)
{
    try {
        $query = 'delete from ingredient where recetteId in (select recetteId from recette where userId = :userId)';
        $deleteAllRecetteFromId = $dbh->prepare($query);
        $deleteAllRecetteFromId->execute([
            'userId' => $_SESSION["user"]->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteAllRecetteFromUser($pdo)
{
    try {
        $query = 'delete from recette where userId = :userId';
        $deleteAllRecetteFromId = $pdo->prepare($query);
        $deleteAllRecetteFromId->execute([
            'userId' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


function selectMyRecette($pdo)
{
/*
Fonction selectMyRecette
---------------------------------
BUT : aller rechercher les caractéristiques des recettes de l'utilisateur connecté dans la BDD
IN : $pdo reprenant toutes les informations de connections
OUT : objet $pdo contenant les recettes de l'utilisateur connecté de la BDD
*/
    try {
        //requête avec critères et paramètre !
        $query = 'select * from recette where userId = :userId';
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            //le paramètre est l'id de l'utilisateur connecté
            'userId' => $_SESSION['user']->id
        ]);
        $recette = $selectRecette->fetchAll();
        return $recette;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/*
Fonction createRecette
-----------------------------
BUT : ajouter les données d'une école encodées pas l'utilisateur dans la table recette
IN : $pdo reprenant toutes les infos de connection
*/


function createRecette($pdo)
{
    try {
        $query = 'insert into recette (recetteNom, recetteImage, userId)
        values (:recetteNom, :recetteImage, :userId)';
        $addRecette = $pdo->prepare($query);
        $addRecette->execute([
            'recetteNom' => $_POST['nom'],
            'recetteImage' => $_POST['image'],
            'userId' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/*
Fonction selectOneRecette
------------------------------
BUT : aller rechercher les caractéristiques de la recette avtive dans la BDD
IN : $pdo reprenant toutes les infos de connexion
OUT : objet pdo contenant toutes les onfos concernant les recettes actives
*/
function selectOneRecette ($pdo)
{
    try{
        $query = "select * from recette where recetteId = :recetteId";
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            "recetteId" => $_GET["recetteId"]  //récupération du paramètre se trouvant dans l'adresse
        ]);
        $recette = $selectRecette->fetch();    //récupération d'une recette (pas fetchAll)
        return $recette;
    } catch(PDOException $e) 
    {
        $message = $e->getMessage();
        die($message);
    }
}

/*
Fonction selectAllIngredients
----------------------------------
BUT : aller rechercher les caractéristiques de toutes les options disponibles dans la BDD
IN : $pdo reprenant toutes les infos de connexion
OUT : objet pdo contenant la liste de toute les recettes existantes de la BDD
*/ 
function selectAllIngredients($pdo)
{
    try {
        $query = 'SELECT * FROM recette';
        $selectIngredients = $pdo->prepare($query);
        $selectIngredients->execute();
        $options = $selectIngredients->fetchAll();
        return $options;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/*
Fonction ajouterIngredientRecette
---------------------------------------
BUT : ajouter les données d'une recette encodées par l'utilisateur dans la table recette
IN : $pdo reprenant toutes les infos de connexion
     $recetteId identifiant de la dernière recette ajoutée à la table des recettes
     $ingredientId identifiant des ingrédiants à ajouter
*/ 
function ajouterIngredientRecette($pdo, $recetteId, $ingredientId)
{
    try {
        $query = 'insert into ingredient (recetteId, ingredientId) values (:recetteId, :ingredientId)';
        $deleteAllRecettesFromId = $pdo->prepare($query);
        $deleteAllRecettesFromId->execute([
            'recetteId' => $recetteId,
            'ingredientId' => $ingredientId
        ]);
    } catch (\PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/*Fonction selectIngredientActifRecette
BUT : aller rechercher dans la BDD les caractéristiques des ingrédients de la recette affichée
IN : $pdo reprenant toutes les infos de connexion
OUT : objet pdo contenant la liste des ingrédients de la recette affichée
*/
function selectIngredientActifRecette($pdo)
{
    try {
        $query = 'select * from ingredient where ingredientId in (select ingredientId from ingredient where recetteId = :recetteId);';
        $selectIngredients = $pdo->prepare($query);
        $selectIngredients->execute([
            'recetteId' => $_GET["recetteId"]
        ]);
        $ingredients = $selectIngredients->fetchAll();
        return $ingredients;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die ($message);
    }
}



function updateRecette($dbh)
{
    try {
        $query = 'update recette set recetteNom = :recetteNom, recetteTempsPrepa, recetteHistorique = :recetteHistorique, recetteImg = :recetteImg where recetteId = :recetteId';
        $updateRecetteFromId = $dbh->prepare($query);
        $updateRecetteFromId->execute([
            'recetteNom' => $_POST['nom'],
            'recetteTempsPrepa' => $_POST['temps_prepa'],
            'recetteHistorique' => $_POST['historique'],
            'recetteImage' => $_POST["image"],
            'recetteId' => $_GET["recetteId"]
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteIngredientRecette($dbh)
{
    try{
        $query = 'delete from ingredientRecette where recetteId = :recetteId';
        $deleteAllRecetteFromId = $dbh->prepare($query);
        $deleteAllRecetteFromId->execute([
            'recetteId' => $_GET['recetteId']
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteOneRecette($pdo)
{
    try {
        $query = 'delete from recette where recetteId = :recetteId';
        $deleteAllRecetteFromId = $pdo->prepare($query);
        $deleteAllRecetteFromId->execute([
            'recetteId' => $_GET['recetteId']
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
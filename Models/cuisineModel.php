

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

function deleteHistoriqueRecetteFromUser($dbh)
{
    try {
        $query = 'delete from recetteHistorique where recetteId in (select recetteId from recette where userId = :userId)';
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
    try {
        $query = 'select * from recette where userId = :userId';
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            'userId' => $_SESSION['user']->id
        ]);
        $recette = $selectRecette->fetchAll();
        return $recette;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


function createRecette($pdo)
{
    try {
        $query = 'insert into recette (recetteNom, recetteImage, userId)
        values (:recetteNom, :recetteImage, :userId)';
        $addPlat = $pdo->prepare($query);
        $addPlat->execute([
            'recetteNom' => $_POST['nom'],
            'recetteImage' => $_POST['image'],
            'userId' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectOneRecette ($pdo)
{
    try{
        $query = "select * from recette where recetteId = :recetteId";
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            "recetteId" => $_GET["recetteId"]
        ]);
        $recette = $selectRecette->fetch();
        return $recette;
    } catch(PDOException $e) 
    {
        $message = $e->getMessage();
        die($message);
    }
}
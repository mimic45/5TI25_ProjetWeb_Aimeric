

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

function deleteAllRecetteFromUser($pdo)
{
    try {
        $query = 'delete from recette where utilisateurId = :utilisateurId';
        $deleteAllRecetteFromId = $pdo->prepare($query);
        $deleteAllRecetteFromId->execute([
            'utilisateurId' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteOptionsRecetteFromUser($dbh)
{
    try {
        $query = 'delete from option_recette where recetteId in (select recetteId from recette where utilisateurId = :utilisateurId)';
        $deleteAllRecetteFromId = $dbh->prepare($query);
        $deleteAllRecetteFromId->execute([
            'utilisateurId' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectMyRecette($pdo)
{
    try {
        $query = 'select * from recette where utilisateurId = :utilisateurId';
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            'utilisateurId' => $_SESSION['user']->id
        ]);
        $recette = $selectRecette->fetchAll();
        return $recette;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectAllOptions($pdo)
{
    try {
        $query = 'SELECT * FROM optionrecette';
        $selectOptions = $pdo->prepare($query);
        $selectOptions->execute();
        $options = $selectOptions->fetchAll();
        return $options;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function createRecette($pdo)
{
    try {
        $query = 'insert into recette (recetteNom, recetteImage, utilisateurId)
        values (:recetteNom, :recetteImage, :utilisateurId)';
        $addPlat = $pdo->prepare($query);
        $addPlat->execute([
            'recetteNom' => $_POST['nom'],
            'recetteImage' => $_POST['image'],
            'utilisateurId' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function ajouterOptionRecette ($pdo, $recetteId, $optionId)
{
    try {
        $query='insert into option_recette (recetteId, optionrecetteId) values (:recetteId, :optionrecetteId)';
        $deleteAllRecettesFromId = $pdo->prepare($query);
        $deleteAllRecettesFromId->execute([
            'recetteId' => $recetteId,
            'optionrecetteId' => $optionId
        ]);
    } catch (\PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectOptionsActiveRecette($pdo)
{
    try{
        $query = "select * from recette where recette in (select recette from recette where recetteId = :recetteId);";
                    
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            "recetteId" => $_GET["Recette"]
        ]);
        $option = $selectRecette->fetch();
        return $option;
    } catch(PDOException $e) 
    {
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
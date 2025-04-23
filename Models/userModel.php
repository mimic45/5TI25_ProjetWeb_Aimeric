<?php
function createUser($pdo)
{
    try {
        $query = 'insert into utilisateur (userNom, userPrenom, userPassWord, userEmail)
        values (:userNom, :userPrenom, :userPassWord, :userEmail)';
        $ajouteUser = $pdo->prepare($query);
        $ajouteUser->execute([
            'userNom' => $_POST['nom'],
            'userPrenom' => $_POST['prenom'],
            'userPassWord' => $_POST['mot_de_passe'],
            'userEmail' => $_POST['email'],
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message); 
    }

}

function connectUser($pdo)
{
    try {
        $query = 'select * from utilisateur where userEmail = :userEmail and userPassWord = :userPassWord';
        $connectUser = $pdo->prepare($query);
        $connectUser->execute([
            'userEmail' => $_POST['email'],
            'userPassWord' => $_POST['mot_de_passe']
        ]);
        $user = $connectUser->fetch();
        if (!$user) {
            return false;
        }
        else {
            $_SESSION['user'] = $user;
            return true;
        }
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function updateUser($pdo)
{
    try {
        $query = 'update utilisateur set userNom = :userNom, userPrenom = :userPrenom, userPassWord = :userPassWord, userEmail = :userEmail where id = :id';
        $ajouteUser = $pdo->prepare($query);
        $ajouteUser->execute([
            'userNom' => $_POST['nom'],
            'userPrenom'=> $_POST['prenom'],
            'userPassWord' => $_POST['mot de passe'],
            'userEmail' => $_POST['email'],
            'id' => $_SESSION['user']->id
        ]);
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);
    }

    
}

function updateSession($pdo)
{
    try {
        $query = 'select * from utilisateur where id = :id';
        $selectUser = $pdo->prepare($query);
        $selectUser->execute([
            'id' => $_SESSION['user']->id
        ]);
        $user = $selectUser->fetch();
        $_SESSION['user'] = $user;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function DeleteUser($pdo)
{
    try {
        $query = 'delete from utilisateur where userid = :userid';
        $delUser = $pdo->prepare($query);
        $delUser->execute([
            'id' => $_SESSION['user']->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


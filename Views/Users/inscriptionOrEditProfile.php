
<div class="flex space-evenly wrap">
    
    <form method="post" action="">
        <fieldset>
            <legend>Inscription</legend>
            <div class="mb-3">
                <label for="Nom" class="form-label">Nom</label>
                <input type="text" placeholder="Nom" class="form-control" id="nom" name="nom" required <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->userNom ?>" <?php endif ?>>
            </div>
            <div class="mb-3">
                <label for="Prenom" class="form-label">Prénom</label>
                <input type="text" placeholder="Prénom" class="form-control" id="prenom" name="prenom" required <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->userPrenom ?>" <?php endif ?>>
                    
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" placeholder="Email" class="form-control" id="email" name="email" required <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->userEmail ?>" <?php endif ?>>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Mot de passe</label>
                <input type="password" placeholder="Mot de passe" class="form-control" id="mot_de_passe" name="mot_de_passe" required <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->userPassWord ?>" <?php endif ?>>
            </div>
            <div>
                <button name="btnEnvoi" class="btn btn-primary">Envoyer</button>
            </div>
            
        </fieldset>
    </form>
</div>
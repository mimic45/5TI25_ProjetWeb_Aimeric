<div class="flex space-evenly wrap">
    <form method="post" action="">
        <fieldset>
            <legend>Se connecter</legend>
            <div class="mb-3">
                <label for="Login" class="form-label">Email</label>
                <input type="text" placeholder="Email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Mot de passe</label>
                <input type="password" placeholder="Mot de passe" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div>
                <button name="btnEnvoi" class="btn btn-primary">Envoi</button>
            </div>
        </fieldset>
        <div>
            <h4 class="text-danger">Pas encore inscrit ?</h4>
            <a href="inscription" class="btn btn-secondary">Cliquez ici !</a>
        </div>
    </form>
</div>
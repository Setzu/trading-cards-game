<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/05/16
 * Time: 03:18
 */
?>

<div class="standard-box">
    <h2>Connexion</h2>
    <div class="row justify-content-md-center">
        <form action="" method="post" role="form" id="register-form" class="form-style">

            <div class="form-group">
                <label for="username">Nom d'utilisateur :
                    <input type="text" name="username" required="required" placeholder="John Doe" class="form-control">
                </label>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :
                    <input type="password" name="password" required="required" class="form-control" placeholder="Mot de passe">
                </label>
            </div>
            <button type="submit" class="btn btn-success">Se connecter</button>
            <br>
            <a href="/password">Mot de passe perdu ?</a>
        </form>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/05/16
 * Time: 03:19
 */
?>


<div class="standard-box">
    <h2>Inscription</h2>

    <form action="/authentification/registration" method="post" role="form" id="registration-form">
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label" style="text-align: right;">Email</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required="required"
                       value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : null; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label" style="text-align: right;">Pseudo</label>
            <div class="col-sm-8">
                <input type="text" name="username" class="form-control" id="username" placeholder="John Doe"
                       value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : null; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label" style="text-align: right;">Mot de passe</label>
            <div class="col-sm-8">
                <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe">
            </div>
        </div>
        <div class="form-group row">
            <label for="confirm-password" class="col-sm-2 col-form-label" style="text-align: right;">Confirmer le mot de passe</label>
            <div class="col-sm-8">
                <input name="confirm-password" type="password" class="form-control" id="confirm-password" placeholder="Mot de passe">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-8">
                <a href="/authentification">Déjà un compte ?</a>
            </div>
            <div class="col-sm-2" style="text-align: right;">
                <input name="registrationToken" type="hidden" id="registrationToken" value="<?= $this->registrationToken; ?>" />
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </div>
    </form>
</div>
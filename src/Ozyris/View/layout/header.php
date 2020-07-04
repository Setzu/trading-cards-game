<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 14:36
 */
?>

<nav class="navbar navbar-expand-lg">
    <a id="logo" class="" href="/">
        <img src="/../img/logo/mycollection.png" alt="logo" width="55" height="55">
    </a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="btn btn-outline-dark nav-link" href="/">
                <svg class="bi bi-house-door-fill" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                    <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                </svg>
                Accueil
            </a>
        </li>
    </ul>

<?php if (array_key_exists('user', $_SESSION) && $_SESSION['user'] instanceof \Ozyris\Service\Users) { ?>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a href='/collection' class="btn btn-outline-primary">Mes cartes</a>
        </li>
        &nbsp;
        <li class="nav-item active">
            <a href='/shop' class="btn btn-outline-primary">Boutique</a>
        </li>
        &nbsp;
        <li class="nav-item active">
            <a href='/friend' class="btn btn-outline-primary">Amis</a>
        </li>
    </ul>

    <!-- ICONE RUBIS -->
    <a href="/shop" class="btn btn-outline-dark">
        <span id="rubis"><?= $_SESSION['rubis']; ?></span>
        <svg class="bi bi-gem" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #ea2900;">
            <path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"/>
        </svg>
    </a>

    <!-- ICONE PROFIL -->
    <a href="/" class="btn" style="color: #000000;">
        <svg class="bi bi-person-circle" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
        </svg>
    </a>

    <!-- ICONE ENVELOPPE -->
    <a href="/reception" class="btn">
        <!-- Ajouter condition si mail non lu -->
        <?php if ($_SESSION['isNewMessage']) { ?>
        <svg class="bi bi-circle-fill" width="8" height="8" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="float: right; color: #11e400;">
            <circle cx="8" cy="8" r="8"/>
        </svg>
        <?php } ?>
        <svg class="bi bi-envelope-fill" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
        </svg>
    </a>

    <!-- BOUTON DECONNEXION -->
    <form class="form-inline my-2 my-lg-0" action="/authentification/disconnect" method="post" role="form" id="login-form">
        <button type="submit" class="btn btn-outline-danger my-2 my-sm-2" name="submit">Se deconnecter</button>
    </form>

<?php } else { ?>
    <a href="/authentification" class="btn btn-outline-success mr-sm-2">Se connecter</a>
    <a href="/authentification/registration" class="btn btn-outline-primary mr-sm-2">S'inscrire</a>
<?php } ?>

</nav>


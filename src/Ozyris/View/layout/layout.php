<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 13:54
 */

use Ozyris\Controller\IndexController;

$oIndexController = new IndexController();
?>

<html lang="fr">

<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/../css/layout.css">
    <link rel="stylesheet" type="text/css" href="/../css/texts-effects.css">
    <link rel="stylesheet" type="text/css" href="/../css/items.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>

<header>
    <?php include_once (__DIR__ . '/header.php'); ?>
</header>

<div class="container-fluid">
    <div class="row justify-content-md-center flashmessage">
        <div class="col-md-6">
            <?php $oIndexController->flashMessages(); ?>
        </div>
    </div>

    <?php \Ozyris\Service\Dispatch::dispatch(); ?>
</div>

<footer>
    <div class="container">
        <?php include_once (__DIR__ . '/footer.php'); ?>
    </div>
</footer>

</body>

</html>

<!doctype html>
<html>
    <head>
        <title>EasyLibrary</title>
        <!-- META -->
        <meta charset="utf-8">
        <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
        <link rel="icon" href="data:;base64,=">
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css"/> 
        <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/material.min.css" />
        <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/ripple.min.css" />
        <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
        <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/navbar.css" />
        <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/datepicker.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>
    <body>
        <nav class="navbar navbar-info navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= Config::get("URL") ?>">Easy Library</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php if (Session::userIsLoggedIn()) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= Config::get("URL") ?>/login/logout">Logout</a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
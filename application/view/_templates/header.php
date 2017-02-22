<!doctype html>
<html>
    <head>
        <title>EasyLibrary</title>
        <!-- META -->
        <meta charset="utf-8">
        <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
        <link rel="icon" href="data:;base64,=">
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= Config::get("URL") ?>">Easy Library</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php if (Session::userIsLoggedIn()) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="<?= Config::get("URL") ?>/login/logout">Logout</a></li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
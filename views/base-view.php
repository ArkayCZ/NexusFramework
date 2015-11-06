<!DOCTYPE html>

<html>
    <head>
        <base href="/framework" />
        <title><?= $title ?></title>
        <meta charset="UTF-8" />
        <meta name="description" content="<?= $description ?>" />
        <meta name="keywords" content="<?= $keywords ?>" />
        <link rel="stylesheet" href="res/styles/main.css" type="text/css" />
    </head>

    <body>
        <header>NexusFramework</header>

        <article>
            <?php $this->innerController->createView(); ?>
        </article>

        <footer>
            <p>NexusFramework - an MVC framework</p>
        </footer>
    </body>
</html>
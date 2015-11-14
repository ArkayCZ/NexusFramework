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
        <header><h1>NexusFramework</h1></header>

        <div class="message-box">
            <?php foreach($messages as $message) : ?>
            <div class="message">
                <p><?= $message ?></p>
            </div>
            <?php endforeach ?>
        </div>

        <br clear="both" />

        <article>
            <?php $this->innerController->createView(); ?>
        </article>

        <footer>
            <p>NexusFramework - an MVC framework</p>
        </footer>
    </body>
</html>
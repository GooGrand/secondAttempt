<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/localhost" />
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>

<body>
<header>
    <h1>MVC practice</h1>
</header>

<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="user/signup">Sign up</a></li>
        <li><a href="user">Login</a></li>
    </ul>
</nav>
<br clear="both" />

<article>
    <?php include 'app/views/'.$content_view; ?>
</article>

<footer>

</footer>
</body>
</html>
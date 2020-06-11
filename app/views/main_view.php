<h1>Home page</h1>

<p>Now you cannot do anything, but we will fix it soon</p>
<br>
<?php if (isset($_SESSION['user'])): ?>
<p>You are logged</p>
<?php endif ?>

<?php if (!isset($_SESSION['user'])):?>
<p>You are not logged</p>
<?php endif ?>

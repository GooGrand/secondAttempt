<h1>User editor</h1>

<form method="POST">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>" />
    Name<br />
    <input type="text" name="name" value="<?= $user['name'] ?>" /><br />
    Surname<br />
    <input type="text" name="surname" value="<?= $user['surname'] ?>" /><br />
    Email<br />
    <input type="email" name="email" value="<?= $user['email'] ?>" /><br />
    Birthday<br />
    <input type="date" name="birthday" value="<?= $user['birthday'] ?>" /><br />
    <input type="submit" value="Save parameters" />
</form>
<?php


class UserModel extends Model
{


    // Returns a list of all of the articles in the database
    public function getUsers()
    {
        return Database::queryAll('
                        SELECT `user_id`, `name`, `surname`, `email`, `birthday`
                        FROM `users`
                        ORDER BY `user_id` DESC
                ');
    }

    public function saveUser($id, $user)
    {
        if (!$id)
            Database::insert('users', $user);
        else
            Database::update('users', $user, 'WHERE user_id = ?', array($id));
    }

    public function removeUser($user_id)
    {
        Database::query('
                DELETE FROM users
                WHERE user_id = ?
        ', array($user_id));
    }

    public function computeHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function register($name, $surname, $email, $birthday, $password, $passwordRepeat)
    {
        if ($password === $passwordRepeat)
        $user = array(
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'birthday' => $birthday,
            'password' => $this->computeHash($password),
        );
        try {
            Database::insert('users', $user);
        }
        catch (PDOException $ex)
        {
            throw $ex;
        }
    }

    public function login($email, $password)
    {
        $user = Database::queryOne('
            SELECT user_id, email, name, admin, password
            FROM users 
            WHERE email = ?
        ', array($email));
        if (!$email || !password_verify($password, $user['password']))
            throw
        $_SESSION['user'] = $user;
    }

    public function logoff()
    {
        unset($_SESSION['user']);
    }
    public function getUser()
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return null;
    }
}
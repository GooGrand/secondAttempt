<?php


class UserModel extends Model
{


    // Returns a list of all of the articles in the database
    public function getUsers()
    {
        return self::queryOne('
                        SELECT `user_id`, `name`, `surname`, `email`, `birthday`
                        FROM `users`
                        ORDER BY `user_id` DESC
                ');
    }

    public function saveUser($id, $user)
    {
        if (!$id)
            self::insert('users', $user);
        else
            self::update('users', $user, 'WHERE user_id = ?', array($id));
    }

    public function removeUser($user_id)
    {
        self::query('
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
        $this->logout();

        if ($password === $passwordRepeat)
        $user = array(
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'birthday' => $birthday,
            'password' => $this->computeHash($password),
        );
        try {
            self::insert('users', $user);
        }
        catch (PDOException $ex)
        {
            throw $ex;
        }
    }

    public function login($email, $password)
    {
        $user = self::queryOne('
            SELECT `user_id`, `email`, `name`, `admin`, `password`
            FROM `users` 
            WHERE `email` = ?
        ', array($email));
        if (!$email || !password_verify($password, $user['password']))
            echo 'Wrong password or email';
        else
        $_SESSION['user'] = $user;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
    public function getUser()
    {
        if (isset($_SESSION['user']))
        {
            echo $_SESSION['user'];
            return $_SESSION['user'];
        }
        else
        {
            return null;
        }
    }
}
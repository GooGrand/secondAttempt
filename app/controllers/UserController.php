<?php


class UserController extends Controller
{
    function index()
    {
        $userModel = new UserModel();
        if ($userModel->getUser() != null)
            header('Location:/main/');

       if(isset($_POST['email']) && isset($_POST['password']))
       {
           if ($_POST)
           {
               try
               {
                   $userModel->login($_POST['email'], $_POST['password']);
                   header('Location:/main');
               }
               catch (UserException $ex)
               {
                   throw $ex;
               }
           }
        }
        else
        {
            $data["login_status"] = "";
        }

        $this->view->generate('signin_view.php', 'template_view.php');

    }

    public function signup()
    {
        $this->head['title'] = 'Register';

        if ($_POST)
        {
            try {
                $userModel = new UserModel();
                $userModel->register($_POST['name'],$_POST['surname'], $_POST['email'], $_POST['birthday'], $_POST['password'], $_POST['password_repeat']);
                $userModel->login($_POST['email'], $_POST['password']);
                header('Location:/main');
            }
            catch (UserException $ex)
            {
                throw $ex;
            }
        }
        $this->view->generate('signup_view.php', 'template_view.php');
    }

    public function logout()
    {
        $userModel = new UserModel();
        if ($userModel->getUser() == null)
            header('Location:/main/');

        $model = new UserModel();
        $model->logout();
        header('Location:/main/');
        echo 'yoy have successfully logged out';
    }
}
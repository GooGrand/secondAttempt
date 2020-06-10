<?php


class UserController extends Controller
{
    function index()
    {
       if(isset($_POST['email']) && isset($_POST['password']))
       {
           $userModel = new UserModel();
           if ($userModel->getUser())
              header('Location:/main/');

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

        $this->view->generate('signin_view.php', 'template_view.php', $data);

    }

    public function signup()
    {
        $this->head['title'] = 'Register';

        if ($_POST)
        {
            try {
                $userModel = new UserModel();
                $userModel->register($_POST['name'],$_POST['surname'], $_POST['email'], $_POST['birthday'], $_POST['password'], $_POST['password_repeat'], $_POST['abc']);
                $userModel->login($_POST['email'], $_POST['password']);
                $this->redirect('main');
            }
            catch (UserException $ex)
            {
                throw $ex;
            }
        }
        $this->view->generate('signup_view.php', 'template_view.php');
    }
}
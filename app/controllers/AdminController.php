<?php


class AdminController extends Controller
{
    public function index($params)
    {
        $model = new UserModel();
        $page = 0;
        $per_page = 5;
        $this->data['num_pages'] = $model->getRows($per_page);
        $this->data['cur_page'] = $this->getCurPage($params, $per_page);
        $this->data['users'] = $model->getPage($per_page, $this->data['cur_page']);
        $this->data['page'] = $page;
        $this->data['username'] = $_SESSION['user']['name'];
        $this->view->generate('admin_view.php', 'template_view.php', $this->data);
    }

    public function getCurPage($getParams, $per_page)
    {
        $cur_page = !empty($getParams['page'])?$getParams['page']:1;
        if ($cur_page > $this->data['num_pages'] || $cur_page < 0)
        {
            $cur_page = 1;
        }
        return $cur_page;
    }


    public function edit($params)
    {
        // HTML head
        $this->head['title'] = 'User editor';
        $userModel = new UserModel();
        // Prepares an empty article
        $user = array(
            'user_id' => '',
            'name' => '',
            'surname' => '',
            'email' => '',
            'birthday' => '',
        );
        if ($_POST)
        {
            $keys = array('name', 'surname', 'email', 'birthday');
            $user = array_intersect_key($_POST, array_flip($keys));
            $userModel->saveUser($_POST['user_id'], $user);
            header('Location:/admin/');
        }
        // Was the article URL entered with the intent to edit said article?
        else if (!empty($params))
        {
            $loadedUser = $userModel->getUser($params);
            if ($loadedUser)
                $user = $loadedUser;
            else
                echo "User wasn't found";
        }

        $this->data['user'] = $user;
        $this->view->generate('edit_user_view.php', 'template_view.php', $this->data);
    }
    public function remove($params)
    {
        $model = new UserModel();
        $id = parse_url($params);
        $model->removeUser($params);
        header('Location:/admin/');
    }
}





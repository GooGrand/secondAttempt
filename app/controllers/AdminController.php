<?php


class AdminController extends Controller
{
    public function index()
    {
        $page = 0;
        $per_page = 2;
        $this->data['cur_page'] = $this->getCurPage();
        $this->data['num_pages'] = $this->getRows($per_page);
        $this->data['users'] = $this->getPage($per_page);
        $this->data['page'] = $page;

        $this->view->generate('admin_view.php', 'template_view.php', $this->data);
    }

    public function getCurPage()
    {
        $cur_page = 1;
        if (isset($_GET['page']) && $_GET['page'] > 0)
            $cur_page = $_GET['page'];
        return $cur_page;
    }

    public function getPage($per_page)
    {
        include_once 'SafeMySQL.php';
        $model = new SafeMySQL();
        $cur_page = $this->getCurPage();
        $start = ($cur_page - 1) * $per_page;
        $sql  = "SELECT SQL_CALC_FOUND_ROWS * FROM `users` LIMIT ?i, ?i";
        return $data = $model->getAll($sql, $start, $per_page);
    }
    public function getRows($per_page)
    {
        include_once 'SafeMySQL.php';
        $model = new SafeMySQL();
        $rows = $model->getOne("SELECT COUNT(*) FROM `users`");
        return $num_pages = ceil($rows / $per_page);

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





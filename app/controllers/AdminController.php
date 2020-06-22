<?php


class AdminController extends Controller
{
    public function index($params)
    {
        $page = 0;
        $per_page = 5;
        $this->data['cur_page'] = $this->getCurPage($params, $per_page);
        $this->data['num_pages'] = $this->getRows($per_page);
        $this->data['users'] = $this->getPage($per_page, $params, $per_page);
        $this->data['page'] = $page;
        $this->view->generate('admin_view.php', 'template_view.php', $this->data);
    }

    public function getCurPage($getParams, $per_page)
    {
        $cur_page = !empty($getParams['page'])?$getParams['page']:1;
        if ($cur_page > $this->getRows($per_page) || $cur_page < 0)
        {
            $cur_page = 1;
        }
        return $cur_page;
    }

    public function getPage($offset, $params, $per_page)
    {
        $model = new UserModel();
        $cur_page = $this->getCurPage($params, $per_page);
        $limit = ($cur_page - 1) * $offset;
        $sql  = "SELECT * 
                  FROM users 
                  LIMIT ?, ?";
        return $data = $model->getPageForPg($sql, $limit, $offset);
    }
    public function getRows($per_page)
    {
        $model = new UserModel();
        $rows = $model->queryOne("SELECT COUNT(*) FROM `users`");
        return $num_pages = ceil(implode($rows) / $per_page);
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





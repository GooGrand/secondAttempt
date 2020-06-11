<?php


class AdminController extends Controller
{
    public function index()
    {
        $page = 0;
        $per_page = 2;
        $cur_page = $this->getCurPage();
        $num_pages = $this->getRows($per_page);

        $this->view->generate('admin_view.php', 'template_view.php', $cur_page, $num_pages, $page);
    }

    public function logout()
    {
        session_destroy();
        header('Location:/');
    }
    public function getCurPage()
    {
        $cur_page = 1;
        if (isset($_GET['page']) && $_GET['page'] > 0)
            $cur_page = $_GET['page'];
        return $cur_page;
    }

    public function getPage()
    {
        $db = new Database();
        $cur_page = $this->getCurPage();
        $start = ($cur_page - 1) * $this->per_page;
        $sql  = "SELECT SQL_CALC_FOUND_ROWS * FROM `users` LIMIT ?i, ?i";
        return $data = $db->queryAll($sql, $start, $this->per_page);
    }
    public function getRows($per_page)
    {
        $rows = (integer) Database::queryOne("SELECT COUNT(*) FROM `users`");
        #Проблема заключается в этой функции, потому что она выдает 0, из за которого нет цикла while
        return $num_pages = ceil($rows / $per_page);
    }
}





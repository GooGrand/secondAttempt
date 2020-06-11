<?php


class Controller
{
    public $model;
    public $view;
    public $data;

    function __construct()
    {
        $this->view = new View();
    }

    function index()
    {

    }
    public function renderView()
    {
        if ($this->view)
        {
            extract($this->protect($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("views/" . $this->view . ".php");
        }
    }


    private function protect($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->protect($v);
            }
            return $x;
        }
        else
            return $x;
    }
}
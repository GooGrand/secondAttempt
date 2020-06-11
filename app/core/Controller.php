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

    // действие (action), вызываемое по умолчанию
    function index()
    {

    }
}
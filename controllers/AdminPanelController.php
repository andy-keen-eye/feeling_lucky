<?php

use lib\Helpers;
use lib\Model;

class AdminPanelController
{
    private $helpers;
    private $model;

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->model = new Model();
    }

    public function index()
    {
        $users = $this->model->selectAllUsers();
        $this->helpers->render('../views/adminpanel.php', $users);
        exit;
    }
}
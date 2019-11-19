<?php

use lib\Model;

class SaveEditController
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        if ((! empty($_POST['username'])) && (! empty($_POST['phone_number']))) {
            date_default_timezone_set('Europe/Kiev');
            $expire_date = date('Y-m-d H:i:s', strtotime('+7 day', time()));
            $user = $this->model->updateUser($_POST, $expire_date);
        }
        header('Location: '.'/adminpanel');
        exit;
    }
}
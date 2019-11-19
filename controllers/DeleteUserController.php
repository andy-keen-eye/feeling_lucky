<?php

use lib\Model;

class DeleteUserController
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        if (! empty($_POST['userId'])) {
            $user = $this->model->deleteUser($_POST['userId']);
            echo (json_encode('User deleted successfully'));
            exit;
        } else {
            echo (json_encode('Error'));
            exit;
        }
    }
}
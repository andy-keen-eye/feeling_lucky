<?php

use lib\Helpers;
use lib\Model;

class EditPageController
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
        if (! empty($_GET['userId'])) {
            $user = $this->model->selectUser($_GET['userId']);
            if (empty($user)) {
                header('Location: /');
                exit;
            }
        } else {
            header('Location: /');
            exit;
        }

        $this->helpers->render('../views/edit_user.php', $user);
        exit;
    }
}
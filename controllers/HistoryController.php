<?php

use lib\Model;
use lib\Authorisation;

class HistoryController
{
    private $model;
    private $auth;

    public function __construct()
    {
        $this->model = new Model();
        $this->auth = new Authorisation();
    }

    public function index()
    {
        $is_auth = $this->auth->is_authorise();

        if ($is_auth) {
            $user = $this->model->selectUser($is_auth['user_id']);
            if (! empty($user['feeling_lucky'])) {
                $feeling_lucky = unserialize($user['feeling_lucky']);
            } else {
                $feeling_lucky[] = 0;
            }
            echo (json_encode($feeling_lucky));
            exit;
        }
        header('Location: /');
        exit;
    }
}
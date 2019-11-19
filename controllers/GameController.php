<?php

use lib\Helpers;
use lib\Model;
use lib\Authorisation;

class GameController
{
    private $helpers;
    private $model;
    private $auth;

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->model = new Model();
        $this->auth = new Authorisation();
    }

    public function index()
    {
        $is_auth = $this->auth->is_authorise();

        if ($is_auth) {
            $user = $this->model->selectUser($is_auth['user_id']);

            date_default_timezone_set('Europe/Kiev');
            $current_date = date('Y-m-d H:i:s', time());

            if ((! empty($_GET['link'])) &&
                ($_GET['link'] == $user['link']) &&
                ($current_date < $user['expire_date'])
            ) {
                $link = '/page-A?link='.$user['link'];
                $this->helpers->render('../views/page-a.php', [$link]);
                exit;
            }
        }
        header('Location: /');
        exit;
    }
}
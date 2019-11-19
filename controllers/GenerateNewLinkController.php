<?php

use lib\Model;
use lib\Authorisation;
use lib\Generator;

class GenerateNewLinkController
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
            $link_array = Generator::generate();

            date_default_timezone_set('Europe/Kiev');
            $expire_date = date('Y-m-d H:i:s', strtotime('+7 day', time()));

            $this->model->updateLink($is_auth['user_id'], $link_array['unique_num'], $expire_date);

            echo (json_encode('page-A?link='.$link_array['unique_num']));
            exit;
        }
        header('Location: /');
        exit;
    }
}
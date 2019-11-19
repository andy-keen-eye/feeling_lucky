<?php

use lib\Model;
use lib\Authorisation;

class DeactivateLinkController
{
    private $helpers;
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

            date_default_timezone_set('Europe/Kiev');
            $expire_date = date('Y-m-d H:i:s',time());
            $this->model->deactivateLink($is_auth['user_id'], $expire_date);

            echo (json_encode('deactivated'));
            exit;
        }
        echo (json_encode('error'));
        exit;
    }
}
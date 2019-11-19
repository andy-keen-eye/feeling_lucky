<?php

use lib\Helpers;
use lib\Model;
use lib\Generator;

class RegisterController
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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            //var_dump();exit;
            $this->helpers->render('../views/register.php', []);
            exit;
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (($_POST["username"] == NULL) || ($_POST["phone_number"] == NULL)) {
                $error = 'error';
                $this->helpers->render('../views/register.php', [$error]);
                exit;
            }

            $link_array = Generator::generate();

            date_default_timezone_set('Europe/Kiev');
            $expire_date = date('Y-m-d H:i:s', strtotime('+7 day', time()));

            $inserted_id = $this->model->insertUser(
                $_POST["username"],
                $_POST["phone_number"],
                $link_array['unique_num'],
                $expire_date
            );

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            setcookie("user", $inserted_id);
            $this->helpers->render('../views/unique_link.php', [$link_array['link']]);
            exit;
        } else {
            die;
        }
    }
}
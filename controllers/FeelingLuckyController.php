<?php

use lib\Model;
use lib\Authorisation;

class FeelingLuckyController
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
            $random_num = rand(1, 1000);

            if ($random_num % 2 == 0) {
                switch ($random_num) {
                    case ($random_num > 900):
                        $prise = $random_num * 0.7;
                        //var_dump($prise);
                        break;
                    case ($random_num > 600):
                        $prise = $random_num * 0.5;
                        //var_dump($prise);
                        break;
                    case ($random_num > 300):
                        $prise = $random_num * 0.3;
                        //var_dump($prise);
                        break;
                    default:
                        $prise = $random_num * 0.1;
                        //var_dump($prise);
                        break;
                }
            } else {
                $prise = 'Lose';
                //var_dump($prise);
            }
            $user = $this->model->selectUser($is_auth['user_id']);
            if (! empty($user['feeling_lucky'])) {
                $feeling_lucky = unserialize($user['feeling_lucky']);
                //var_dump($feeling_lucky);
                if (count ($feeling_lucky) >= 3) {
                    //array_shift($feeling_lucky);
                    array_pop($feeling_lucky);
                }
            } else {
                $feeling_lucky = [];
            }
            array_unshift($feeling_lucky, ['random_num' => $random_num, 'win_lose' => $prise]);
            //$feeling_lucky[] = ['random_num' => $random_num, 'wl' => $prise];
            $feeling_lucky = serialize($feeling_lucky);
            $this->model->updateHistory($is_auth['user_id'], $feeling_lucky);

            echo (json_encode(['random_num' => $random_num, 'win_lose' => $prise]));
            exit;
        }
        echo ('not authorised');
        exit;
    }
}
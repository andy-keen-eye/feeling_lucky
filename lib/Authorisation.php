<?php
namespace lib;

class Authorisation
{
    public function is_authorise()
    {
        if (! empty($_COOKIE['user'])) {
            return ['user_id' => $_COOKIE['user']];
        } else {
            return false;
        }
    }
}
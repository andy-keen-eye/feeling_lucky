<?php
namespace lib;

class Helpers
{
    //render views
    public function render($view, $values = [])
    {
        extract ($values);
        require('../views/header.php');
        require($view);
        require('../views/footer.php');
    }
}
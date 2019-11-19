<?php
namespace lib;

class Generator
{
    public static function generate()
    {
        $unique_num = uniqid();
        return ['link' => '/page-A?link='.$unique_num, 'unique_num' => $unique_num];
    }
}
<?php
class controller
{
    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }
}

<?php

class Comments
{
    public function index($params = [])
    {
        extract($params);

        if (!empty($params)) {
            pr($params);
        } else {
            echo 'No params';
        }
    }
}

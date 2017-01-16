<?php

class App extends Kernel
{
    protected function config()
    {
        return parse_ini_file('../config/config.ini', false);
    }

}

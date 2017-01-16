<?php

class Loader
{
    private $dirs = [];

    public function __construct($dirs)
    {
        foreach ($dirs as $dir) {
            $this->dirs[] = realpath($dir);
        }

        $this->load();
    }

    private function load()
    {
        spl_autoload_register(function ($class) {
            foreach ($this->dirs as $dir) {
                $file = $dir . '/' . $class . '.php';
                if (is_readable($file)) {
                    require_once $file;
                }
            }
        });
    }
}

<?php

class Response
{
    private static $headers = [];

    public function addHeader($header)
    {
        self::$headers[] = $header;
    }

    public function addHeaders(array $headers = [])
    {
        self::$headers = array_merge(self::$headers, $headers);
    }

    public static function sendHeaders()
    {
        if (!headers_sent()) {
            foreach (self::$headers as $header) {
                header($header, true);
            }
        }
    }

    public static function render($path, $data = false, $error = false)
    {
        self::sendHeaders();

        require __DIR__ . '/../views/' . $path . '.php';
    }
}

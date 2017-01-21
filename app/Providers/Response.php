<?php
namespace App\Providers;

class Response
{
    private static $headers = [];

    public static function addHeader($header)
    {
        self::$headers[] = $header;
    }

    public static function addHeaders(array $headers = [])
    {
        self::$headers = array_merge(self::$headers, $headers);
    }

    public static function sendHeaders()
    {
        if (!headers_sent())
        {
            if (!empty(self::$headers))
            {
                foreach (self::$headers as $header)
                {
                    header($header);
                }
            }
            else
            {
                header('HTTP/1.0 200 OK');
            }
        }
    }

    public static function render($data)
    {
        //self::sendHeaders();
        echo $data;
    }
}

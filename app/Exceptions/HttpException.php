<?php
namespace App\Exceptions;

use App\Providers\Request;
use App\Providers\View;

class HttpException extends \Exception
{
    public function __construct(array $e)
    {
        $content = [];

        switch ($e['error'])
        {
            case 403:
                View::make('errors/403', ['error' => 'Invalid url: ' . Request::get('url')]);
                break;
            case 404:
                echo View::make('errors/404.twig', ['error' => Request::get('url')]);
                //Response::addHeader('HTTP/1.1 404 Not Found');
                break;
            case 500:
                View::make('errors/500', ['error' => 'Invalid url: ' . Request::get('url')]);
                break;
            case 503:
                View::make('errors/503', ['error' => 'Invalid url: ' . Request::get('url')]);
                break;
            default:
                View::make('errors/404', ['error' => 'Invalid url: ' . Request::get('url')]);
                break;
        }
        //Response::render($content);
    }
}

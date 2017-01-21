<?php
namespace App\Exceptions;

use App\Providers\Request;
use App\Providers\Response;
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
                $content = View::make('errors/404', ['error' => 'Invalid url: ' . Request::get('url')]);
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
        Response::addHeader('HTTP/1.1 404 Not Found');
        Response::render($content);
    }
}

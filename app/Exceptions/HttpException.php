<?php
namespace App\Exceptions;

use App\Providers\Request;
use App\Providers\Response;

class HttpException extends \Exception
{
    public function __construct(array $e)
    {
        switch ($e['error'])
        {
            case 403:
                Response::render('errors/403');
                break;
            case 404:
                Response::render('errors/404', ['error' => 'Invalid url: ' . Request::get('url')]);
                break;
            case 500:
                Response::render('errors/500');
                break;
            case 503:
                Response::render('errors/503');
                break;
            default:
                Response::rednder('errors/404');
                break;
        }
    }
}

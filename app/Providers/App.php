<?php
namespace App\Providers;

use App\Exceptions\HttpException;

class App
{
    public function __construct()
    {
        $this->runApp(Router::getInstance()->getParams());
    }

    private function runApp($params = [])
    {
        try {
            if ($params !== false)
            {
                extract($params);

                if ($controller !== false)
                {
                    $controller = $this->runController($controller);

                    if ($controller !== false)
                    {
                        $method = $this->runMethod($controller, $method, $params);

                        if ($method !== false)
                        {
                            if (is_array($method))
                            {
                                Response::render($method[0], $method[1]);
                            }
                        }
                        else
                        {
                            throw new HttpException($method . ' ==> Method not found.');
                        }
                    }
                    else
                    {
                        throw new HttpException($controller . ' ==> Controller not found.');
                    }
                }
                else
                {
                    $method = call_user_func_array($method, $params);

                    if (is_array($method))
                    {
                        if (!empty($method) && array_key_exists('view', $method) && $method['view'] === true)
                        {
                            Response::render($method[0], $method[1]);
                        }
                        else
                        {
                            echo '<pre>', print_r($method, true), '</pre>';
                        }
                    }
                    else
                    {
                        echo $method;
                    }
                    exit;
                }
            }
            else
            {
                throw new HttpException(Request::get('url') . ' ==> URL not found.');
            }
        }
        catch (HttpException $e)
        {
            echo ($e);
        }
    }

    private function runController($controller)
    {
        if (!class_exists($controller))
        {
            $controller = "App\Http\Controllers\\$controller";

            return new $controller($this);
        }

        return false;
    }

    private function runMethod($controller, $method, $params)
    {
        if (method_exists($controller, $method))
        {
            return call_user_func_array([$controller, $method], $params);
        }

        return false;
    }
}
